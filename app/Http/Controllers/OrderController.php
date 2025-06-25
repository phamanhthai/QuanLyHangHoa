<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        $orders = $user->orders()->with('orderItems.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create(Request $request)
    {
        $products = Product::where('stock', '>', 0)->get();
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity', 1);
        return view('orders.create', compact('products', 'productId', 'quantity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
        ], [
            'product_id.required' => 'Sản phẩm là bắt buộc.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn 0.',
            'shipping_address.required' => 'Địa chỉ giao hàng là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Số lượng sản phẩm không đủ trong kho.');
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $product->price * $request->quantity,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);

            // Update product stock
            $product->decrement('stock', $request->quantity);

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $user = auth()->user();
        // Check if user owns this order or is admin
        if (!$user || ($order->user_id !== $user->id && !$user->isAdmin())) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }
}
