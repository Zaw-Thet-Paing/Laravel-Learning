@extends('user.layouts.master')
@section('title', 'User - Home')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <h3>Category Lists</h3>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <a href="{{ route('user.productByCategory', $category) }}" class="list-group-item">{{ $category->name }}</a>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h3 class="text-center">Product Lists</h3>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">{{ $product->name }}</h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ $product->photos[0]->image_url }}" alt="" style="height: 150px">
                                <div>
                                    <strong>Price : </strong>{{ $product->price }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('user.productDetails', $product->id) }}" class="btn btn-primary btn-sm">See More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
