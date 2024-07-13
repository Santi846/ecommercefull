<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoLibreController;

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

Route::get('/mercado-libre/authenticate', [MercadoLibreController::class, 'authenticate']);
Route::get('/mercado-libre/callback', [MercadoLibreController::class, 'callback']);