@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{route('jobs.create')}}">Create a Job</a>
                        </div>
                    </div>


                    @if (session()->has('success'))
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('danger'))
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('danger') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('primary'))
                         <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ session()->get('primary') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Created at</th>
                                @if(auth()->user()->hasRole('admin'))
                                    <th>Created by</th>
                                @endif
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{$job->created_at_formatted}}</td>
                                    @if(auth()->user()->hasRole('admin'))
                                        <td>{{$job->user->name}}</td>
                                    @endif
                                    <td>
                                        @if (is_null($job->media_url))
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="img-thumbnail">
                                        @else
                                        <img src="{{$job->media_url}}" alt="" class="img-thumbnail">

                                        @endif

                                    </td>
                                    <td>{{$job->title}}</td>
                                    <td class="d-flex justify-content-between">
                                        <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{route('jobs.delete', $job->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
