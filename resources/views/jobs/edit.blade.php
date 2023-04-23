@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
           <form action="{{route('jobs.update', $job['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input name="title" value="{{$job['title']}}" type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                    <input name="company" value="{{$job['company']}}" type="text" class="form-control @error('company') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Company Name">
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Location</label>
                    <input name="location" value="{{$job['location']}}" type="text" class="form-control @error('location') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Location">
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Website</label>
                    <input name="website" value="{{$job['website']}}" type="text" class="form-control @error('website') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Website">
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tags</label>
                    <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple aria-label="multiple select example">
                        <option @if(is_null($job['tags'])) selected @endif>Need Many Employee</option>
                        <option @if(in_array("urgent", $job['tags'])) selected @endif value="urgent">Urgent</option>
                        <option @if(in_array("vacancy", $job['tags'])) selected @endif value="vacancy">Vacancy</option>
                        <option @if(in_array("high priority", $job['tags'])) selected @endif value="high priority">High Priority</option>
                    </select>
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input name="email" value="{{$job['email']}}" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Job Description</label>
                    <textarea name="descript" class="form-control @error('descript') is-invalid @enderror" id="exampleFormControlInput1"  placeholder="Job Description">
                        {{$job['descript']}}
                    </textarea>
                       @error('descript')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                @if (!is_null($job['media_url']))
                    <img src="{{$job['media_url']}}" alt="" class="img-thumbnail">
                @endif

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        @if (!is_null($job['media_url']))
                            Change Photo
                        @else
                            Photo
                        @endif
                    </label>
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
@endsection
