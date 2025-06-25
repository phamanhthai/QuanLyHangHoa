@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold leading-tight">Order #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Orders</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
        <div class="md:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Order Items</h3>
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $item->product->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $item->quantity }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($item->price, 2) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right mt-4">
                    <p class="text-gray-600">Total: <span class="font-bold text-xl">{{ number_format($order->total_amount, 2) }}</span></p>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Order & Customer Details</h3>
                <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p class="mt-4"><strong>Shipping Address:</strong></p>
                <p>{{ $order->shipping_address }}</p>

                <hr class="my-6">

                <h4 class="text-lg font-semibold mb-2">Update Status</h4>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                        <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                        <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                        <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                        <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                    </select>
                    <button type="submit" class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 