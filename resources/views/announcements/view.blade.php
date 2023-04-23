@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-md-8">
                            <div class="card">
                              <div class="card-header">
                                Announcement Details
                              </div>
                              <div class="card-body">
                                @isset($announcement)
                                  <div class="card mb-3">
                                    <img src="{{$announcement->media_url}}" class="card-img-top" alt="">
                                    <div class="card-body">
                                      <h5 class="card-title">{{$announcement->title}}</h5>
                                      <p class="card-text">{{$announcement->descript}}</p>
                                      <hr>
                                      <h6>Tags</h6>
                                      @if (count($announcement->tags) > 0)
                                        @foreach ($announcement->tags as $tag)
                                          <span class="badge bg-primary">{{$tag}}</span>
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                                @else
                                  <p>No data found</p>
                                @endisset
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
