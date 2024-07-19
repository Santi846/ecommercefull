<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\MercadoLibreController;
use App\Models\User;
use App\Models\CustomerToken;
use App\Models\SellerToken;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

//seller
Route::get('/seller', [MercadoLibreController::class, 'showSeller'])->name('seller.index');
Route::post('/refreshSeller', [MercadoLibreController::class, 'handleMercadoLibreCallbackRefreshSeller'])->name('mercadolibre.RefreshSeller');
Route::get('/refreshSeller', [MercadoLibreController::class, 'handleMercadoLibreCallbackRefreshSeller'])->name('mercadolibre.getRefreshSeller');

//customer
Route::get('/customer', [MercadoLibreController::class, 'showTokenCustomer'])->name('customer.index');
Route::post('/refreshCustomer', [MercadoLibreController::class, 'handleMercadoLibreCallbackRefreshCustomer'])->name('mercadolibre.RefreshCustomer');

//product
Route::get('/create', [ProductController::class, 'create'])->name('create');
Route::get('/showProducts', [MercadoLibreController::class, 'showSeller'])->name('show.products');
Route::post('/store', [ProductController::class, 'store'])->name('store');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');

//order
Route::get('/orderListItem/{id}', [OrderController::class, 'orderListItem'])->name('orderListItem');
Route::post('/addToOrder/{id}', [OrderController::class, 'addToOrder'])->name('addToOrder');
Route::get('/showOrder', [OrderController::class, 'showOrder'])->name('showOrder');
Route::get('/showOrderReserved', [OrderController::class, 'showOrderReserved'])->name('showOrderReserved');
Route::get('/showOrderItems', [OrderController::class, 'showOrderItems'])->name('showOrderItems');

//shopping
Route::get('/showShopping', [OrderController::class, 'showShopping'])->name('showShopping');
Route::delete('/{id}', [OrderController::class, 'destroyOrder'])->name('destroyOrder');
Route::post('/purchase/{customerId}', [OrderController::class, 'purchase'])->name('purchase');
Route::post('/addMoneyToCustomer/{customerId}', [OrderController::class, 'addMoneyToCustomer'])->name('addMoneyToCustomer');
