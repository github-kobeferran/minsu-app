@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
           <form action="{{route('jobs.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
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
@endsection
