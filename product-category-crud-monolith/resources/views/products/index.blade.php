@extends('layouts.layout')
@section('title', 'Product Page')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if (session('product_create_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('product_create_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('product_updated_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('product_updated_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('product_delete_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('product_delete_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('landing.index') }}" class="btn btn-secondary mb-2">Back</a>
            <a href="{{ route('product.create') }}" class="btn btn-primary mb-2">Create</a>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Product Page</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category['name'] }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-secondary btn-sm" style="width: 80px; display: inline-block;">Edit</a>
                                        <form action="{{ route('product.delete', $product->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" style="width: 80px">Delete</button>
                                        </form>
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

