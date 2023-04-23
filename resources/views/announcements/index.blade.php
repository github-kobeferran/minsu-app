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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcementModal">
                                Create New Announcement
                              </button>
                        </div>                        
                        @endif
                    </div>
                    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="announcementModalLabel">Create New Announcement</h5>
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1st Year Students" id="tag1" name="tags[]">
                                        <label class="form-check-label" for="tag1">
                                            1st Year Students
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2nd Year Students" id="tag2" name="tags[]">
                                        <label class="form-check-label" for="tag2">
                                            2nd Year Students
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="3rd Year Students" id="tag3" name="tags[]">
                                        <label class="form-check-label" for="tag3">
                                            3rd Year Students
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="4th Year Students" id="tag4" name="tags[]">
                                        <label class="form-check-label" for="tag4">
                                            4th Year Students
                                        </label>
                                    </div>
                                    @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                      
                                <div class="mb-3">
                                  <label for="descript" class="form-label">Announcement Description</label>
                                  <textarea class="form-control" id="descript" name="descript" placeholder="Job Description"></textarea>
                                  @error('descript')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                      
                                <div class="mb-3">
                                  <label for="photo" class="form-label">Photo</label>
                                  <input name="photo"  type="file"  id="photo">
                                  @error('photo')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                      
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                      
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary">Create Announcement</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      

                      @if (session()->has('success'))
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                      <script>
                          Swal.fire({
                              icon: 'success',
                              text: '{{ session()->get('success') }}'
                          });
                      </script>
                  @endif
                  
                  @if (session()->has('danger'))
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                      <script>
                          Swal.fire({
                              icon: 'error',
                              text: '{{ session()->get('danger') }}'
                          });
                      </script>
                  @endif
                  
                  @if (session()->has('primary'))
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                      <script>
                          Swal.fire({
                              icon: 'info',
                              text: '{{ session()->get('primary') }}'
                          });
                      </script>
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
                                                    <a href="#" class="btn btn-danger" onclick="deleteAnnouncement({{$announcement->id}})">Delete</a>


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
    var createAnnouncementModal = new bootstrap.Modal(document.getElementById('createAnnouncementModal'), {
        keyboard: false
    });

    @if($errors->any())
        createAnnouncementModal.show();
    @endif

    function handleModal() {
        createAnnouncementModal.show();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function deleteAnnouncement(announcementId) {
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
          window.location.href = "{{route('announcements.delete', '')}}/" + announcementId;
        }
      });
    }
    </script>
    
