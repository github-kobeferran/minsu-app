<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreJobApply;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobApply $request)
    {
        abort_if(!auth()->user()->can('apply job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $apply = Apply::create($request->validated());

        if ($request->has('resume')) {
            $apply->addMediaFromRequest('resume')->toMediaCollection('resume');
        }

        $jobs = Job::paginate(10);

        session()->flash('success', 'Record added');

        return redirect()->route('jobs.index')->with([
            'jobs' => $jobs,
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
