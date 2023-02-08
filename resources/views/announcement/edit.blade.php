@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
           <form  action="{{route('announcements.update', $announcement->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('patch')
            <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" value="{{$announcement->title}}" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message}}</strong>
                    </span>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tags</label>
                    <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple aria-label="multiple select example">

                        <option @if(is_null($announcement['tags'])) selected @endif>Open this select menu</option>
                        <option @if(in_array("urgent", $announcement['tags'])) selected @endif value="urgent">Urgent</option>
                        <option @if(in_array("example1", $announcement['tags'])) selected @endif value="example1">Example1</option>
                        <option @if(in_array("example12", $announcement['tags'])) selected @endif value="example12">Example12</option>
                    </select>
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Announcement Description</label>
                    <textarea type="text" class="form-control" id="exampleFormControlInput1" name="descript" placeholder="Announcement Description">
                        {{$announcement->descript}}
                    </textarea>
                    @error('descript')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                @if (!is_null($announcement['media_url']))
                    <img src="{{$announcement['media_url']}}" alt="" class="img-thumbnail">
                @endif

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        @if (!is_null($announcement['media_url']))
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
