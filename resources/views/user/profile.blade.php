@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white">{{ $user->name }}'s Profile</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <div class="text-center">
                  <img src="{{ $user->profile_image }}" class="img-fluid rounded-circle" alt="Profile Image">
                </div>
              </div>
              <div class="col-sm-8">
                <h3 class="mb-3">{{ $user->name }}</h3>
                <p class="lead"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="lead"><strong>Work Address:</strong> {{ $user->work_address }}</p>
                <p class="lead"><strong>Department:</strong> {{ $user->department }}</p>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  
  
@endsection
