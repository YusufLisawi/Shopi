<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Home;
use App\Http\Livewire\ProductDetails;
use Illuminate\Http\Request;
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

Route::post('/add-to-cart', [Cart::class, 'addToCart'])->name('cart.add');
Route::post('/inc-qty', [Cart::class, 'incQty'])->name('qty.up');
Route::post('/dec-qty', [Cart::class, 'decQty'])->name('qty.down');
Route::delete('/destroy-item', [Cart::class, 'destroyItem'])->name('destroy.item');
Route::delete('/destroy-cart', [Cart::class, 'destroyCart'])->name('destroy.cart');
Route::get('/cart', [Cart::class, 'render'])->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [Checkout::class, 'render'])->name('checkout');
    Route::post('/checkout-order', [Checkout::class, 'makeOrder'])->name('checkout.order');
    Route::get('/checkout-success', [Checkout::class, 'success'])->name('checkout.success');
    Route::get('/checkout-cancel', [Checkout::class, 'cancel'])->name('checkout.cancel');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/invoice/{order}', [Dashboard::class, 'invoice'])->name('invoice');
    Route::get('/dashboard/invoice/pdf/{order}', [Dashboard::class, 'invoicePdf'])->name('invoice.pdf');
    Route::get('/dashboard', [Dashboard::class, 'render'])->name('dashboard');
});


require __DIR__.'/auth.php';
