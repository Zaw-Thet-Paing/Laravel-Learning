@extends('layouts.layouts')
@section('title', 'Profile Page')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('profile_updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('profile_updated') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Profile Page</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="">Bio</label>
                            <input type="text" name="bio" value="{{ $user->profile['bio'] }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ $user->profile['phone_number'] }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Address</label>
                            <input type="text" name="address" value="{{ $user->profile['address'] }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="post" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
