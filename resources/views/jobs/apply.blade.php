@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">

          
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
           <form action="{{route('apply.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="job_id" value="{{$job->id}}">
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input name="name" value="{{auth()->user()->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Contact Number</label>
                    <input name="number" value="Contact Number" type="text" class="form-control @error('number') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="number Name">
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input name="email" value="{{auth()->user()->email}}" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Resume</label>
                    <input name="resume"  type="file"  id="">
                    @error('resume')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    {{-- <a class="btn btn-primary" href="{{ route('jobs.show' , $job->id)}}">Apply</a> --}}
                    <input type="submit" class="btn btn-primary" value="Apply"/>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection
