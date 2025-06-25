@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="mb-4">
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Quay lại danh sách đơn hàng
            </a>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Chi tiết đơn hàng #{{ $order->id }}</h1>
        </div>

        <!-- Order Status -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm text-gray-500">Trạng thái: </span>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
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
                </div>
                <div class="text-sm text-gray-500">
                    Đặt hàng lúc: {{ $order->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Sản phẩm đã đặt</h2>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="h-12 w-12 rounded object-cover mr-4">
                                    @else
                                        <div class="h-12 w-12 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->product->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->price) }} VNĐ</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Shipping Information -->
            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <h3 class="text-lg font-semibold mb-3">Thông tin giao hàng</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Địa chỉ:</span>
                        <p class="text-gray-900">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Số điện thoại:</span>
                        <p class="text-gray-900">{{ $order->phone }}</p>
                    </div>
                    @if($order->notes)
                    <div>
                        <span class="font-medium text-gray-700">Ghi chú:</span>
                        <p class="text-gray-900">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Order Total -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Tổng đơn hàng</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Tổng tiền:</span>
                        <span class="font-bold text-xl text-blue-600">{{ number_format($order->total_amount) }} VNĐ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 