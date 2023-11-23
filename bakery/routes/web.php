<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
use App\Http\Livewire\Cart;
use App\Http\Livewire\History;
use App\Http\Controllers\TransactionChart;
use App\Http\Controllers\KasirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'App\Http\Controllers\TransactionChart@index')->middleware(['auth'])->name('dashboard');


Route::get('/produk', Product::class)->middleware(['auth'])->name('produk');

Route::get('/order', Cart::class)->middleware(['auth'])->name('order');
Route::get('/transaksi', History::class)->middleware(['auth'])->name('transaksi');
Route::get('/transaksi/detail/{invoice_number}', 'App\Http\Livewire\History@detail')->middleware(['auth']);
Route::get('/laporan/export_excel', 'App\Http\Livewire\History@export_excel')->middleware(['auth']);

Route::get('/cetak_struk', 'App\Http\Controllers\KasirController@cetak_struk')->middleware(['auth']);

require __DIR__.'/auth.php';
