<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ProductTransaction;
use DB;

class KasirController extends Controller
{
    //
    public function cetak_struk(){
        $transactions = Transaction::latest()->first();
        $invoice_number = $transactions->invoice_number;
        $productTransactions = ProductTransaction::where('invoice_number', $invoice_number)->get();

        return view('export.struk', compact('transactions', 'productTransactions'));
    }
}
