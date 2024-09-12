@extends('admin.layouts.master')
@section('title', 'Admin - Dashboard')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Category Lists</a>
            <a href="" class="btn btn-primary">Product Lists</a>
            <a href="" class="btn btn-primary">User Lists</a>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
