@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-6">Chỉnh sửa danh mục</h1>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Tên danh mục</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">Mô tả</label>
                <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lưu thay đổi</button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection 