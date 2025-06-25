<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\OrderController as UserOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [UserProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class);
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User order routes
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [UserOrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';
