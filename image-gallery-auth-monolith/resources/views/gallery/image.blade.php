@extends('gallery.layouts.master')
@section('title', 'Gallery - Upload')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ $image->title }}</h2>
                </div>
                <div class="card-body">
                    <div class="text-center mb-2">
                        <img src="{{ Storage::url($image->image_url) }}" class="img-thumbnail" style="height: 300px">
                    </div>
                    <p><strong>Description : </strong> {{ $image->description }}</p>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100">
                        <a href="{{ route('gallery.edit', $image->id) }}" class="btn btn-secondary w-50">Edit</a>
                        <a href="{{ route('gallery.destroy', $image->id) }}" class="btn btn-danger w-50" onclick="return confirm('Are you sure')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
