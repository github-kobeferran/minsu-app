<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('access announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $announcements = Announcement::paginate(10);
        return view('announcements.index', compact(['announcements']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnnouncementRequest $request)
    {
        abort_if(!auth()->user()->can('store announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $announcement = Announcement::create($request->validated());
        if ($request->has('photo')) {
            $announcement->addMediaFromRequest('photo')->toMediaCollection('photos');
        }
        $announcements = Announcement::paginate(10);

        session()->flash('success', 'Announcement has been posted');

        return redirect()->route('announcements.index')->with([
            'announcements' => $announcements,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        abort_if(!auth()->user()->can('show announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('announcements.view', [
            'announcement' => $announcement,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', [
            'announcement' => $announcement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        abort_if(!auth()->user()->can('update announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $announcement->update($request->validated());

        if ($request->has('photo')) {
            $announcement->clearMediaCollection('photos');
            $announcement->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        session()->flash('success', 'Announcement has been updated');

        $announcements = Announcement::paginate(10);

        return redirect()->route('announcements.index')->with([
            'announcements' => $announcements,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        abort_if(!auth()->user()->can('destroy announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        Announcement::destroy($id);
        $announcements = Announcement::paginate(10);

        session()->flash('primary', 'Announcement has been deleted');

        return redirect()->route('announcements.index')->with([
            'announcements' => $announcements,
        ]);
    }
}
