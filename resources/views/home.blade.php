@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-success text-white">
    <div class="container">
      <h1 class="display-4 text-center">Welcome to MinSU-AlumnConnect</h1>
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
                
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ __('You are logged in!') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @if (!auth()->user()->approved)
                        <div class="col-md-8">
                
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ __('Please wait for admin approval to access site') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                </div>
                            
                        @else
                        <div class="col-md-8">
                
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ __('Welcome to AllumnConnect!') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                </div>
                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
