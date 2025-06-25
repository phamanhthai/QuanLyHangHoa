@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-3xl mx-auto mt-8">
    <div class="p-8 text-gray-900">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Quay lại danh sách</a>
        <div class="flex flex-col md:flex-row gap-8">
            <div class="flex-shrink-0">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded">
                @else
                    <div class="w-48 h-48 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">Danh mục: <span class="font-semibold">{{ $product->category->name ?? 'Không xác định' }}</span></p>
                <p class="mb-4">{{ $product->description }}</p>
                <div class="mb-2">
                    <span class="font-semibold">Giá:</span> <span class="text-lg text-green-700 font-bold">{{ number_format($product->price) }} VNĐ</span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Tồn kho:</span>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($product->stock > 10) bg-green-100 text-green-800
                        @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $product->stock }}
                    </span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Ngày tạo:</span> {{ $product->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 