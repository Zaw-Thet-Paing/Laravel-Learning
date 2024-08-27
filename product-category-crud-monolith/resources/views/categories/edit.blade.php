@extends('layouts.layout')
@section('title', 'Category Edit Page')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('category_edit_failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ session('category_edit_failed') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('category.index') }}" class="btn btn-secondary mb-2">Back</a>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Category Edit Page</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Enter category name" autofocus>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

@endsection

