@extends('admin.layouts.master')
@section('title', 'Admin - Products')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if (session('created'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('created') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('updated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="mb-2">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create Product</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Product Lists</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-primary" style="width: 80px">Details</a>
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-secondary" style="width: 80px">Edit</a>
                                    <a href="{{ route('admin.product.destroy', $product->id) }}" class="btn btn-danger" style="width: 80px" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
