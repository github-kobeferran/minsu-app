@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>

                    @isset($announcement)
                        <table class="table table-bordered">
                            <tr>
                                <th>Title</th>
                                <td>{{$announcement->title}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>
                                    @if (count($announcement->tags) > 0)
                                        @foreach ($announcement->tags as $tag)
                                            <span class="badge bg-primary">{{$tag}}</span>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$announcement->descript}}</td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                <td>
                                    <img src="{{$announcement->media_url}}" alt="" class="img-thubmnail w-50">
                                </td>
                            </tr>
                        </table>
                    @else
                        No data found
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
