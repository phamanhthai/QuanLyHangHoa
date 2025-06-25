<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Chuyển hướng về trang products.index (dashboard mới)
        return redirect()->route('admin.products.index');
    }
}
