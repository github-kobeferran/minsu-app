<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
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
        $announcement = Announcement::paginate(10);
        return view('announcement.index', compact(['announcement']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnnouncementRequest $request)
    {
       // abort_if(!auth()->user()->can('store announcement'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $announcement = Announcement::create($request->validated());
        if ($request->has('photo')) {
            $announcement->addMediaFromRequest('photo')->toMediaCollection('photos');
        }
        $announcement->addMediaFromRequest::paginate(10);

        session()->flash('success', 'Record added');

        return redirect()->route('announcement.index')->with([
            'announcement' => $announcement,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
