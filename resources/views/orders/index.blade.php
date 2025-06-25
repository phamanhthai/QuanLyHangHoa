@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-6">Đơn hàng của tôi</h1>

        @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-900">Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Chưa có đơn hàng nào</h3>
            <p class="mt-1 text-sm text-gray-500">Bắt đầu mua sắm để tạo đơn hàng đầu tiên.</p>
            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Xem sản phẩm
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 