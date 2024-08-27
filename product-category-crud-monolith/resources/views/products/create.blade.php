@extends('layouts.layout')
@section('title', 'Product Create Page')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('product_create_failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ session('product_create_failed') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('product.index') }}" class="btn btn-secondary mb-2">Back</a>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Product Create Page</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter product name">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="price" class="form-control" placeholder="Enter product price">
                        </div>
                        <div class="mb-3">
                            <select name="category_id" class="form-control">
                                <option value="">Select Option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

@endsection

