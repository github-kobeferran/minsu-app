@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="list-group mb-4">
                    @if (auth()->user()->hasRole('admin'))
                        <li class="list-group-item">
                            <a href="{{ route('jobs.create') }}">Create Job</a>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <a href="{{ route('admin.pending-users') }}">View Pending Users</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('announcements.create') }}">Create Announcement</a>
                    </li>
                </ul>

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @if (!auth()->user()->approved)
                            Please wait for admin approval to access site
                        @else
                            Welcome
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
