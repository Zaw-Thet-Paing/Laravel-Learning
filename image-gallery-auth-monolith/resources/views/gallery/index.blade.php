@extends('gallery.layouts.master')
@section('title', 'Gallery - Home')
@section('content')
<div class="container mt-3">
    @if (session('uploaded'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('uploaded')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('updated'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('updated')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('delete_failed'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('delete_failed')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('deleted'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('deleted')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $image->title }}</h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($image->image_url) }}" class="img-thumbnail" alt="No image found" style="height: 200px">
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100">
                        <a href="{{ route('gallery.show', $image->id) }}" class="btn btn-primary w-50">View</a>
                        <a href="{{ route('gallery.edit', $image->id) }}" class="btn btn-secondary w-50">Edit</a>
                        <a href="{{ route('gallery.destroy', $image->id) }}" class="btn btn-danger w-50" onclick="return confirm('Are you sure')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
