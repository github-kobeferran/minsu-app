@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{  route('jobs.index') }}">Back</a>
                        </div>
                    </div>
                    @isset($job)
                        <table class="table table-bordered">
                            <tr>
                                <th>Company Name</th>
                                <td>{{$job->company}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>
                                    @if (count($job->tags) > 0)
                                        @foreach ($job->tags as $tag)
                                            <span class="badge bg-primary">{{$tag}}</span>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                <td>
                                    <img src="{{$job->media_url}}" alt="" class="img-thubmnail w-50">
                                </td>
                            </tr>
                            <tr>
                                <th>Job Title</th>
                                <td>{{$job->title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$job->descript}}</td>
                            </tr>
                            <tr>
                                <th>Job Location</th>
                                <td>{{$job->location}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$job->email}}</td>
                            </tr>
                            <tr>
                                <th>Website/Page</th>
                                <td>{{$job->website}}</td>
                            </tr>
                    

                        </table>
                        <div class="mb-4">
                            <a class="btn btn-primary" href="{{ route('jobs.apply', $job->id)}}">Apply</a>
                        </div>
                    @else
                        No data found
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
