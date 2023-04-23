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
        <a href="#" class="btn btn-outline-light mx-3 mb-4" data-toggle="modal" data-target="#createJobModal">Create Job</a>
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
        <a href="#" class="btn btn-outline-light mx-3 mb-4" data-toggle="modal" data-target="#createJobModal">Create Job</a>
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
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        @if (auth()->user()->hasRole('alumni'))
                        @else
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                                Create an Announcement
                            </button>
                        </div>                        
                        @endif
                    </div>
                    
                    <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createAnnouncementModalLabel">Create Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('announcements.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Tags</label>
                                            <select name="tags[]" class="form-control @error('tags')is-invalid @enderror" multiple aria-label="multiple select example" id="tags">
                                                <option selected>1st Year Students</option>
                                                <option value="2nd year students">2nd Year Students</option>
                                                <option value="3rd year students">3rd Year Students</option>
                                                <option value="4th year students">4th Year Students</option>
                                            </select>
                                            @error('tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Announcement Description</label>
                                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Announcement Description"></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input name="photo" type="file" class="form-control" id="photo">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create Announcement</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

                    @isset($announcements)
                    <div>
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @foreach ($announcements as $announcement)
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            @if (is_null($announcement->media_url))
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="card-img">
                                            @else
                                                <img src="{{$announcement->media_url}}" alt="" class="card-img">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$announcement->title}}</h5>
                                                <p class="card-text">{{$announcement->body}}</p>
                                                <p class="card-text"><small class="text-muted">{{$announcement->created_at_formatted}}</small></p>
                                                @if (auth()->user()->hasRole('alumni'))
                                                    <a href="{{route('announcements.show', $announcement->id)}}" class="btn btn-light border">View</a>
                                                @else
                                                    <a href="{{route('announcements.show', $announcement->id)}}" class="btn btn-light border">View</a>
                                                    <a href="{{route('announcements.edit', $announcement->id)}}" class="btn btn-primary">Edit</a>
                                                    <a href="{{route('announcements.delete', $announcement->id)}}" class="btn btn-danger">Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $announcements->links() }}
                        </div>
                    </div>
                    @endisset
                    

                  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

<script>
    var myModal = new bootstrap.Modal(document.getElementById('createAnnouncementModal'), {
        keyboard: false
    })

    @if (count($errors) > 0)
        myModal.show();
    @endif

    function handleModal() {
        myModal.show();
    }
</script>
