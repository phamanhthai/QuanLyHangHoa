@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-6">Chi tiết danh mục</h1>
        <div class="mb-4">
            <strong>Tên danh mục:</strong> {{ $category->name }}
        </div>
        <div class="mb-4">
            <strong>Mô tả:</strong> {{ $category->description ?? 'Không có mô tả' }}
        </div>
        <div class="mb-4">
            <strong>Số sản phẩm:</strong> {{ $category->products->count() }}
        </div>
        @if($category->products->count() > 0)
        <div class="mb-4">
            <h2 class="text-lg font-semibold mb-2">Danh sách sản phẩm thuộc danh mục</h2>
            <ul class="list-disc pl-6">
                @foreach($category->products as $product)
                    <li>
                        <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 hover:underline">{{ $product->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="{{ route('admin.categories.index') }}" class="inline-block mt-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Quay lại danh sách</a>
    </div>
</div>
@endsection 