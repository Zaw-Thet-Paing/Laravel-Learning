@extends('admin.layouts.master')
@section('title', 'Admin - Category')
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
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create Category</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Categories</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-secondary" style="width: 80px">Edit</a>
                                        <a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-danger" style="width: 80px" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
