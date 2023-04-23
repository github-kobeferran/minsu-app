@extends('layouts.app')

@section('content')
<style>
    body{
      background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg')
    }
    </style>
<div class="jumbotron jumbotron-fluid text-white">
    <div class="container">
      <h1 class="display-4 text-center">Welcome to MinSU-AlumConnect</h1>
      <p class="lead text-center">Discover the latest job opportunities and announcements.</p>
      <div class="d-flex justify-content-center mt-4">
        @if (!auth()->user()->approved)
        @else
        @if (auth()->user()->hasRole('admin'))
        <a href="{{ route('jobs.create') }}" class="btn btn-outline-light mx-3 mb-4">Create Job</a>
        <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4">Job Offers</a>
        <a href="{{ route('socialmedia.index') }}" class="btn btn-outline-light mx-3 mb-4">AlumnConnect</a>
        <a href="{{ route('admin.pending-users') }}" class="btn btn-outline-light mx-3 mb-4">View Pending Users</a>
        <a href="{{ route('announcements.create') }}" class="btn btn-outline-light mx-3 mb-4">Create Announcement</a>
        <a href="{{ route('announcements.index') }}" class="btn btn-outline-light mx-3 mb-4">Announcements </a>
        {{--<a href="{{ route('socialmedia.create') }}" class="btn btn-outline-light mx-3">AlumnConnect </a>--}}
        @endif
        @if (auth()->user()->hasRole('alumni'))
        <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4">Job Offers</a>
        <a href="{{ route('socialmedia.index') }}" class="btn btn-outline-light mx-3 mb-4">AlumnConnect</a>
        <a href="{{ route('announcements.index') }}" class="btn btn-outline-light mx-3 mb-4">Announcements </a>
        {{--<a href="{{ route('socialmedia.create') }}" class="btn btn-outline-light mx-3">AlumnConnect </a>--}}
        @endif
        @if (auth()->user()->hasRole('employer'))
        <a href="{{ route('jobs.create') }}" class="btn btn-outline-light mx-3 mb-4">Create Job</a>
        <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4">Job Offers</a>
        {{--<a href="{{ route('socialmedia.create') }}" class="btn btn-outline-light mx-3">AlumnConnect </a>--}}
        @endif
        @endif
      </div>
    </div>
  </div>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
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
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->created_at_formatted}}</td>
                                            <td>{{$user->name}}</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{route('admin.approve-user', $user->id)}}" class="btn btn-primary">Approve</a>
                                                <a href="{{route('admin.decline-user', $user->id)}}" class="btn btn-danger">Decline</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
        </div>
    </div>
</div>
@endsection
