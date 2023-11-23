<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ProductTransaction;
use Carbon\Carbon;
use DB;

class TransactionChart extends Controller
{
    //
    public function index(){
    $totalProduk = Product::count();
    $todaytime = Carbon::now();
  
    $totalOrder = Transaction::whereDate('created_at', $todaytime)->count();
    $totalPenjualan = Transaction::whereDate('created_at', $todaytime)->sum('total');
    $top_produk=DB::select(DB::raw('SELECT product_id, product.nama, product.image, product.harga, SUM(qty) 
    as qtyTotal FROM product_transaction left join product on product.id = product_transaction.product_id GROUP by product_id, product.nama, product.image, product.harga ORDER by qtyTotal DESC LIMIT 3 '));


    $chart_options = [
        'chart_title' => 'Transactions by dates',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\Transaction',
        'group_by_field' => 'created_at',
        'group_by_period' => 'day',
        'aggregate_function' => 'sum',
        'aggregate_field' => 'total',
        'chart_type' => 'line',
    ];

    $chart3 = new LaravelChart($chart_options);

    return view('dashboard', compact('chart3','totalProduk','totalOrder','totalPenjualan'))->with('top_produk', $top_produk);
    }
}
