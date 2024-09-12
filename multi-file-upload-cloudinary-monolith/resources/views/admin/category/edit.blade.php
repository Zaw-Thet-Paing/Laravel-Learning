@extends('admin.layouts.master')
@section('title', 'Admin - Category Edit')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if (session('edit_fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('edit_fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="mb-2">
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Categories</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Category Name</label>
                            <input type="text" value="{{ $category->name }}" name="name" class="form-control" placeholder="Enter category name..." autofocus>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Update Category" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
