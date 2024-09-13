@extends('admin.layouts.master')
@section('title', 'Admin - Product Details')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="mb-2">
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Product Details</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                  @foreach ($product->photos as $photo)
                                    <div class="carousel-item active">
                                        <img src="{{ $photo->image_url }}" class="d-block w-100" alt="Image can't show" style="height: 350px">
                                    </div>
                                  @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Name : </strong> {{ $product->name }}
                            </div>
                            <div class="mb-3">
                                <strong>Price : </strong> {{ $product->price }}
                            </div>
                            <div class="mb-3">
                                <strong>Category : </strong> {{ $product->category->name }}
                            </div>
                            <div class="mb-3">
                                <strong>Description : </strong> {{ $product->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
