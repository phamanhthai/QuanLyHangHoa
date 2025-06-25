@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Quay lại danh sách sản phẩm
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div>
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Danh mục: </span>
                    <span class="text-sm font-medium text-gray-900">{{ $product->category->name }}</span>
                </div>

                <div class="mb-6">
                    <span class="text-3xl font-bold text-blue-600">{{ number_format($product->price) }} VNĐ</span>
                </div>

                <div class="mb-6">
                    <span class="text-sm text-gray-500">Tình trạng: </span>
                    @if($product->stock > 10)
                        <span class="text-sm font-medium text-green-600">Còn hàng</span>
                    @elseif($product->stock > 0)
                        <span class="text-sm font-medium text-yellow-600">Sắp hết hàng</span>
                    @else
                        <span class="text-sm font-medium text-red-600">Hết hàng</span>
                    @endif
                    <span class="text-sm text-gray-500"> ({{ $product->stock }} sản phẩm)</span>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mô tả</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description ?: 'Chưa có mô tả cho sản phẩm này.' }}</p>
                </div>

                @auth
                    @if($product->stock > 0)
                        <form method="POST" action="{{ route('orders.store') }}" class="mb-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <label for="quantity" class="text-sm font-medium text-gray-700">Số lượng:</label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ giao hàng *</label>
                                    <textarea name="shipping_address" id="shipping_address" rows="3" required
                                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shipping_address') border-red-500 @enderror"
                                              placeholder="Nhập địa chỉ giao hàng chi tiết">{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại *</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                                           placeholder="Nhập số điện thoại liên hệ">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Ghi chú</label>
                                    <textarea name="notes" id="notes" rows="2"
                                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                                              placeholder="Ghi chú thêm (không bắt buộc)">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
                                    Đặt hàng ngay
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="mb-6">
                            <button disabled class="w-full bg-gray-400 text-white font-bold py-3 px-6 rounded cursor-not-allowed">
                                Hết hàng
                            </button>
                        </div>
                    @endif
                @else
                    <div class="mb-6">
                        <a href="{{ route('login') }}" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded inline-block text-center">
                            Đăng nhập để đặt hàng
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        @if($relatedProduct->image)
                            <img src="{{ Storage::url($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $relatedProduct->name }}</h3>
                        <p class="text-lg font-bold text-blue-600 mb-2">{{ number_format($relatedProduct->price) }} VNĐ</p>
                        <a href="{{ route('products.show', $relatedProduct) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Xem chi tiết →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 