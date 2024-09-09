@extends('gallery.layouts.master')
@section('title', 'Gallery - Upload')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('update_failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('update_failed')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Edit Photo</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{ $image->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{ $image->description }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Photo</label>
                            <div>
                                <img src="{{ Storage::url($image->image_url) }}" class="img-thumbnail" style="height: 80px">
                            </div>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
