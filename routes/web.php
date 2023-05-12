<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Home;
use App\Http\Livewire\ProductDetails;
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

Route::get('/', [Home::class, 'render'])->name('home');
Route::get('/product/{product_id}', [ProductDetails::class, 'render'])->name('product.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [Cart::class, 'render'])->name('cart');
    Route::get('/checkout', [Checkout::class, 'render'])->name('checkout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
