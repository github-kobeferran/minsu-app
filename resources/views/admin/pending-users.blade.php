@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
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
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Created at</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->created_at_formatted}}</td>
                                    <td>{{$user->name}}</td>
                                    <td class="d-flex justify-content-between">

                                        <a href="{{route('admin.approve-user', $user->id)}}" class="btn btn-primary">Approve</a>
                                        <a href="{{route('admin.approve-user', $user->id)}}" class="btn btn-danger">Decline</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
