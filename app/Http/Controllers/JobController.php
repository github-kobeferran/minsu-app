<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApply;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('access job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $jobs = Job::when(auth()->user()->hasRole('employer'), function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
        ->orderByDesc('created_at')
        ->paginate(10);
        return view('jobs.index', compact(['jobs']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequest $request)
    {
        abort_if(!auth()->user()->can('store job'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $job = Job::create($request->validated());
        if ($request->has('photo')) {
            $job->addMediaFromRequest('photo')->toMediaCollection('photos');
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
    public function show(Job $job)
    {
        abort_if(!auth()->user()->can('access job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('jobs.view', ['job' => $job,]);
    }

    public function goToJobApply(Job $job)
    {
        abort_if(!auth()->user()->can('apply job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('jobs.apply', [
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        abort_if(!auth()->user()->can('edit job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('jobs.edit', compact(['job']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        abort_if(!auth()->user()->can('update job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $job->update($request->validated());

        if ($request->has('photo')) {
            $job->clearMediaCollection('photos');
            $job->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        session()->flash('success', 'Record updated');

        $jobs = Job::paginate(10);

        return redirect()->route('jobs.index')->with([
            'jobs' => $jobs,
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
        abort_if(!auth()->user()->can('destroy job'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        Job::destroy($id);
        return view('jobs.index')->with('flas-message', 'Delete success');
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->can('destroy job'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        Job::destroy($id);
        $jobs = Job::paginate(10);

        session()->flash('primary', 'Record deleted');

        return redirect()->route('jobs.index')->with([
            'jobs' => $jobs,
        ]);
    }
}
