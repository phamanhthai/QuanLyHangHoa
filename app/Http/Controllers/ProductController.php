<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->where('stock', '>', 0);

        // Search by name or description
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        $sortable = ['name', 'price', 'created_at'];
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        if (!in_array($sortBy, $sortable)) {
            $sortBy = 'created_at';
        }
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(12)->appends($request->except('page'));
        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'search' => $request->search,
            'categorySelected' => $request->category,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
