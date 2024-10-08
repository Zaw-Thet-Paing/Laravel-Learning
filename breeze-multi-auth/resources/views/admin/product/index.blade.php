<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-2 d-flex justify-content-between">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
                        @if (Auth::user()->user_type === 'admin')
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center fs-1">Product List</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        @if (Auth::user()->user_type === 'admin')
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->category['name'] }}</td>
                                            @if (Auth::user()->user_type === 'admin')
                                            <td>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-secondary" style="width: 80px">Edit</a>
                                                <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-danger" style="width: 80px" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
