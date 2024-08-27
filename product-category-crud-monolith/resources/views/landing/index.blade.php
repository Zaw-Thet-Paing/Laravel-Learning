@extends('layouts.layout')
@section('title', 'Home Page')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Landing Page</h1>
                </div>
                <div class="card-body">
                    <p class="fs-4">Click on Button you want to go</p>
                    <div class="mt-3">
                        <a href="{{ route('product.index') }}" class="btn btn-primary">Product List</a>
                        <a href="{{ route('category.index') }}" class="btn btn-primary">Category List</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

@endsection

