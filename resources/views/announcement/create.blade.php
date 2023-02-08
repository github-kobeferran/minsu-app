@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
           <form  action="" method="post" enctype="multipart/form-data">
               <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title">
               </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="tags" placeholder="Tags">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Announcement Description</label>
                    <textarea type="text" class="form-control" id="exampleFormControlInput1" name="descript" placeholder="Job Description"></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-submit"/>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection