@extends('layouts.layout')
@section('title', 'Category Page')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('category_create_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('category_create_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('category_edit_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('category_edit_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('category_delete_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('category_delete_success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('landing.index') }}" class="btn btn-secondary mb-2">Back</a>
            <a href="{{ route('category.create') }}" class="btn btn-primary mb-2">Create</a>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Category Page</h1>
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
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary btn-sm" style="width: 80px; display: inline-block;">Edit</a>
                                        {{-- <a href="{{ route('category.delete') }}" class="btn btn-danger btn-sm" style="width: 80px">Delete</a> --}}
                                        <form action="{{ route('category.delete', $category->id) }}" method="post" style="display: inline-block">
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
        <div class="col-md-3"></div>
    </div>
</div>

@endsection

