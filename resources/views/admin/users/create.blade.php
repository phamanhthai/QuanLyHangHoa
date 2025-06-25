@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Thêm người dùng mới</h1>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Quay lại
            </a>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="max-w-2xl">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên người dùng *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu *</label>
                <input type="password" name="password" id="password" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Vai trò *</label>
                <select name="role" id="role" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror">
                    <option value="">Chọn vai trò</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Hủy
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tạo người dùng
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 