@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="mb-4">
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Quay lại danh sách người dùng
            </a>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Chi tiết người dùng</h1>
        </div>

        <!-- User Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Thông tin người dùng</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Tên:</span>
                        <p class="text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Email:</span>
                        <p class="text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Vai trò:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($user->role === 'admin') bg-red-100 text-red-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Ngày tạo:</span>
                        <p class="text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Cập nhật lần cuối:</span>
                        <p class="text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Thống kê</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Tổng đơn hàng:</span>
                        <p class="text-gray-900">{{ $user->orders->count() }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Tổng tiền đã mua:</span>
                        <p class="text-gray-900">{{ number_format($user->orders->sum('total_amount')) }} VNĐ</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Orders -->
        @if($user->orders->count() > 0)
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Lịch sử đơn hàng</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($user->orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($order->total_amount) }} VNĐ</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @switch($order->status)
                                        @case('pending')
                                            Chờ xử lý
                                            @break
                                        @case('processing')
                                            Đang xử lý
                                            @break
                                        @case('shipped')
                                            Đã gửi hàng
                                            @break
                                        @case('delivered')
                                            Đã giao hàng
                                            @break
                                        @case('cancelled')
                                            Đã hủy
                                            @break
                                        @default
                                            {{ ucfirst($order->status) }}
                                    @endswitch
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Chưa có đơn hàng nào</h3>
            <p class="mt-1 text-sm text-gray-500">Người dùng này chưa đặt hàng.</p>
        </div>
        @endif
    </div>
</div>
@endsection 