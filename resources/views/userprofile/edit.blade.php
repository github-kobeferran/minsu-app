@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-9 mx-auto"">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-3">
                        @if ($user->getFirstMediaUrl('photos'))
                            <img src="{{$user['media_url']}}" alt="Profile Photo" class="rounded-circle w-100">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Profile Photo" class="rounded-circle w-100">
                        @endif
                        <form action="{{ route('userprofile.update', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="photo" class="form-label">
                                    @if ($user->getFirstMediaUrl('photos'))
                                        Change Photo
                                    @else
                                        Upload Photo
                                    @endif
                                </label>
                                <input type="file" name="photo" id="photo" accept="image/*">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Photo</button>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <h2>{{ Auth::user()->name }}</h2>
                        <form action="{{ route('userprofile.update', Auth::user()->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="home_address">Home Address</label>
                                <input type="text" name="home_address" id="home_address" value="{{ Auth::user()->home_address }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="work_address">Work Address</label>
                                <input type="text" name="work_address" id="work_address" value="{{Auth::user()->work_address }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" value="{{ Auth::user()->age }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control">
                                    <option value="">Select Department</option>
                                    <option value="sales" {{ Auth::user()->department === 'sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="marketing" {{ Auth::user()->department === 'marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="finance" {{ Auth::user()->department === 'finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="human resources" {{ Auth::user()->department === 'human resources' ? 'selected' : '' }}>Human Resources</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
