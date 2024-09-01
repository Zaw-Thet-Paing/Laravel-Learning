@extends('layouts.layouts')
@section('title', 'Change Password Page')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('password_update_failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ session('password_update_failed') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('profile.index') }}" class="btn btn-secondary mb-2">Back</a>
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Change Password Page</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.changePassword') }}" method="post" onsubmit="return validatePassword()">
                        @csrf
                        <div class="mb-3">
                            <label for="">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="newPassword" id="newPassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<script>
    function validatePassword()
    {
        let newPassword = document.getElementById('newPassword').value;
        let confirmPassword = document.getElementById('confirmPassword').value;

        if(newPassword !== confirmPassword){
            alert("New password and confirm password do not match")
            return false;
        }
        return true;

    }
</script>
@endsection
