@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
           <form  action="{{route('announcements.store')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tags</label>
                    <select name="tags[]" class="form-control @error('tags')is-invalid @enderror" multiple aria-label="multiple select example">
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
                    <label for="exampleFormControlInput1" class="form-label">Announcement Description</label>
                    <textarea type="text" class="form-control" id="exampleFormControlInput1" name="descript" placeholder="Job Description"></textarea>
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
