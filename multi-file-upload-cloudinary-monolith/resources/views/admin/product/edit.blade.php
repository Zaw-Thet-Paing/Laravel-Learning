@extends('admin.layouts.master')
@section('title', 'Admin - Product Create')
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
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Product Edit</h1>
                </div>
                <div class="card-header">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Enter product name..">
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Enter product price...">
                        </div>
                        <div class="mb-3">
                            <label for="">Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Choose option</option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @if ($category->id === $product->category_id)
                                            selected
                                        @endif
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter product description...">{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Product Images</label>
                            <div class="mb-2 mt-3">
                                {{-- @foreach ($product->photos as $photo)
                                    <img src="{{ $photo->image_url }}" alt="" class="img-thumbnail" style="width: 100px; height: 100px">
                                @endforeach --}}
                                @foreach ($product->photos as $photo)
                                <div class="position-relative d-inline-block me-3">
                                    <img src="{{ $photo->image_url }}" alt="" class="img-thumbnail" style="width: 100px; height: 100px">

                                        <!-- Badge on top of the image -->
                                    <a href="{{ route('admin.photo.delete', $photo->id) }}" class="badge bg-danger position-absolute top-0 start-100 translate-middle p-2 rounded-circle"
                                        style="transform: translate(-50%, -50%); font-size: 16px; text-decoration:none">&times;</a>
                                </div>
                                @endforeach
                            </div>
                            <input type="file" name="photos[]" class="form-control" multiple>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Create Product" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
