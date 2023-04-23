
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
              <div>
                  <input type="checkbox" name="tags[]" id="need-many-employee" value="need-many-employee" class="@error('tags') is-invalid @enderror" aria-label="Need Many Employee">
                  <label for="need-many-employee">Need Many Employee</label>
              </div>
              <div>
                  <input type="checkbox" name="tags[]" id="urgent" value="urgent" class="@error('tags') is-invalid @enderror" aria-label="Urgent">
                  <label for="urgent">Urgent</label>
              </div>
              <div>
                  <input type="checkbox" name="tags[]" id="vacancy" value="vacancy" class="@error('tags') is-invalid @enderror" aria-label="Vacancy">
                  <label for="vacancy">Vacancy</label>
              </div>
              <div>
                  <input type="checkbox" name="tags[]" id="high-priority" value="high-priority" class="@error('tags') is-invalid @enderror" aria-label="High Priority">
                  <label for="high-priority">High Priority</label>
              </div>
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
            <div class="row">
                @if (session()->has('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
                <script>
                  Swal.fire({
                    icon: 'success',
                title: '{{ session()->get('success') }}',
                showClass: {

                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
                })
                </script>
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
                    <div class="card-columns">
                        @foreach ($jobs as $job)
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-4 ">
                                @if (is_null($job->media_url))
                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="img-thumbnail">
                                @else
                                <img src="{{$job->media_url}}" alt="" class="img-thumbnail">
                                @endif
                              </div>
                              <div class="col-md-8">
                                <h5 class="card-title">{{$job->title}}</h5>
                                <p class="card-text">{{$job->created_at_formatted}}</p>
                                @if(auth()->user()->hasRole('admin'))
                                <p class="card-text">Created by {{$job->user->name}}</p>
                                @endif
                                <div class="d-flex justify-content-between">
                                  <a href="{{route('jobs.show', $job->id)}}" class="btn btn-light bordered">View</a>
                                  @if (!auth()->user()->hasRole('alumni'))
                                  <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-primary">Edit</a>
                                  <button class="btn btn-danger" onclick="deleteJob({{$job->id}})">Delete</button>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        {{ $jobs->links() }}
                      </div>
                      
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
                      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css" />
                      
                      <script>
                      function deleteJob(jobId) {
                        Swal.fire({
                          title: "Are you sure?",
                          text: "You won't be able to revert this!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#d33",
                          cancelButtonColor: "#3085d6",
                          confirmButtonText: "Yes, delete it!",
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = "{{route('jobs.delete', '')}}/" + jobId;
                          }
                        });
                      }
                      </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
