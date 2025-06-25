@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-6">Đặt hàng</h1>
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="shipping_address">Địa chỉ giao hàng</label>
                <textarea name="shipping_address" id="shipping_address" rows="2" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('shipping_address') }}</textarea>
                @error('shipping_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="notes">Ghi chú (tuỳ chọn)</label>
                <textarea name="notes" id="notes" rows="2" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="product_id">Chọn sản phẩm</label>
                <select name="product_id" id="product_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (old('product_id', $productId ?? '') == $product->id) ? 'selected' : '' }}>
                            {{ $product->name }} (Còn: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="quantity">Số lượng</label>
                <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', $quantity ?? 1) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('quantity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center gap-4 mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Đặt hàng</button>
                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Quay lại mua sắm</a>
            </div>
        </form>
    </div>
</div>
@endsection 