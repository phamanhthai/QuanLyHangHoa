@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Chỉnh sửa sản phẩm</h1>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Quay lại
            </a>
        </div>

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="max-w-2xl">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên sản phẩm *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Giá *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Tồn kho *</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Danh mục *</label>
                <select name="category_id" id="category_id" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                <p class="text-sm text-gray-500 mt-1">Định dạng: JPEG, PNG, JPG, GIF. Tối đa 2MB.</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Hủy
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cập nhật sản phẩm
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 