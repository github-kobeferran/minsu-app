@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{route('announcements.create')}}">Create a announcement</a>
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
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Created at</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $announcement)
                                <tr>
                                    <td>{{$announcement->created_at_formatted}}</td>
                                    <td>
                                        @if (is_null($announcement->media_url))
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930" alt="" class="img-thumbnail">
                                        @else
                                        <img src="{{$announcement->media_url}}" alt="" class="img-thumbnail">

                                        @endif

                                    </td>
                                    <td>{{$announcement->title}}</td>
                                    <td class="d-flex justify-content-center align-content-between ">
                                        <a href="{{route('announcements.show', $announcement->id)}}" class="btn btn-light border">View</a>
                                        <a href="{{route('announcements.edit', $announcement->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{route('announcements.delete', $announcement->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $announcements->links() }}

                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
