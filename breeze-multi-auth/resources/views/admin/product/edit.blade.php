<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-2">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center fs-2">Edit Product</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.update', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Product Name</label>
                                    <input type="text" value="{{ $product->name }}" name="name" class="form-control" placeholder="Product Name..">
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Price</label>
                                    <input type="text" value="{{ $product->price }}" name="price" class="form-control" placeholder="Product Price..">
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Category</label>
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
                                    <input type="submit" value="Create" class="btn btn-primary w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
