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
    <!-- Modal -->
<div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createJobModalLabel">Create Job</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Place your form code here -->
          <form action="{{route('jobs.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Form fields here -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input name="title" value="{{old('title')}}" type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                <input name="company" value="{{old('company')}}" type="text" class="form-control @error('company') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Company Name">
                @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Location</label>
                <input name="location" value="{{old('location')}}" type="text" class="form-control @error('location') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Location">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Website</label>
                <input name="website" value="{{old('website')}}" type="text" class="form-control @error('website') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Website">
                @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tags</label>
                <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple aria-label="multiple select example">
                    <option selected>Need Many Employee</option>
                    <option value="urgent">Urgent</option>
                    <option value="vacancy">Vacancy</option>
                    <option value="high priority">High Priority</option>
                </select>
                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input name="email" value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="name@example.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Job Description</label>
                <textarea name="descript" class="form-control @error('descript') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Job Description">
                    {{old('descript')}}
                </textarea>
                   @error('descript')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Photo</label>
                <input name="photo"  type="file"  id="">
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <div class="mb-3">
                <input name="submit" type="submit" class="btn btn-primary"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      // Hide any error messages when the modal is opened
      $('#createJobModal').on('show.bs.modal', function() {
        $('.modal-body').find('.alert').remove();
        $('.modal-body').find('.is-invalid').removeClass('is-invalid');
      });
  
      // Submit the form when the "Create" button is clicked
      $('#createJobModal').on('click', '#createJobBtn', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var url = form.attr('action');
        var formData = new FormData(form[0]);
        
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            // Handle success response here
          },
          error: function(xhr) {
            // Handle error response here
          }
        });
      });
    });
  </script>
  <!-- Bootstrap CSS -->


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-center">{{$job->title}}</h2>
                    </div>
                </div>
                <div class="card-body mb-3">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a href="#" data-toggle="modal" data-target="#imageModal">
                                @if (is_null($job->media_url))
                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="img-thumbnail">
                                @else
                                <img src="{{$job->media_url}}" alt="" class="img-thumbnail">
                                @endif

                            </a>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>Company Name:</strong> {{$job->company}}</p>
                            <p class="card-text"><strong>Tags:</strong>
                                @if (count($job->tags) > 0)
                                    @foreach ($job->tags as $tag)
                                        <span class="badge bg-primary">{{$tag}}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No tags available</span>
                                @endif
                            </p>
                            <p class="card-text"><strong>Description:</strong> {{$job->descript}}</p>
                            <p class="card-text"><strong>Location:</strong> {{$job->location}}</p>
                            <p class="card-text"><strong>Email:</strong> {{$job->email}}</p>
                            <p class="card-text"><strong>Website/Page:</strong> {{$job->website}}</p>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#applyModal">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Apply to {{$job->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('apply.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" value="{{auth()->user()->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter your name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number">Contact Number</label>
                        <input name="number" value="{{old('number')}}" type="text" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="Enter your contact number">
                        @error('number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" value="{{auth()->user()->email}}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="resume">Resume</label>
                        <input name="resume" type="file" class="form-control-file @error('resume') is-invalid @enderror" id="resume">
                        @error('resume')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">{{$job->title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (is_null($job->media_url))
        <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="img-thumbnail">
        @else
        <img src="{{$job->media_url}}" alt="" class="img-thumbnail">
        @endif
      </div>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

@endsection
