@extends('layouts.app')

@section('content')

<form action="{{route('socialmedia.store')}}" method="POST" enctype="multipart/form-data" class="form-inline d-flex justify-content-center">
    @csrf
    <textarea name="post" rows="2" placeholder="What's on your mind?" class="form-control @error('post') is-invalid @enderror w-50"></textarea>
    @error('post')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" >Post</button>
              </div>
  </form>
  
  <div class="d-flex justify-content-center">
    <input name="photo"  type="file"  id="">
    @error('photo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

</div>

@foreach ($socialmedias as $socialmedia )
<div class="card mt-5" style="width: 22rem; margin: 0 auto;">
    <img src="{{$socialmedia->media_url}}" class="card-img-top" alt="">
    <div class="card-body">
      <p class="card-text">{{$socialmedia->post}}</p>
      <a href="#" class="btn btn-primary">Like</a>
    </div>
  </div>
  @endforeach
@endsection
