@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('jobs.create')}}">Create Job</a>
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
