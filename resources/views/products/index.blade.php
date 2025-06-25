@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-3xl font-bold mb-6">Sản phẩm</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search, Filter, Sort -->
        <div class="mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Tìm kiếm sản phẩm..." 
                       class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="category" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string)old('category', $categorySelected) === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select name="sort_by" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Tên sản phẩm</option>
                    <option value="price" {{ $sortBy === 'price' ? 'selected' : '' }}>Giá</option>
                </select>
                <select name="sort_order" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Giảm dần</option>
                    <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Tăng dần</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tìm kiếm
                </button>
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                        <span class="text-sm text-gray-500">Còn: {{ $product->stock }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-blue-600">{{ number_format($product->price) }} VNĐ</span>
                        <a href="{{ route('products.show', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-8">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Không tìm thấy sản phẩm</h3>
            <p class="mt-1 text-sm text-gray-500">Thử tìm kiếm với từ khóa khác hoặc danh mục khác.</p>
        </div>
        @endif
    </div>
</div>
@endsection 