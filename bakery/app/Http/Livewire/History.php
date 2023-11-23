<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use App\Models\ProductTransaction;

use Livewire\WithPagination;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;
use PDF;

class History extends Component
{
    public $invoice_number;
    public $tglawal;
    public $tglakhir;
 
    public function render()
    {

        $transactions = Transaction::orderBy('created_at', 'DESC')->get();
        return view('livewire.history', [

            'transactions' => $this->tglawal != null && $this->tglakhir != null ?
            Transaction::whereBetween('created_at', [$this->tglawal, $this->tglakhir])->latest()->paginate(10) :
            Transaction::latest()->paginate(10),
        ]);
    }

    use withPagination;
  

    public function detail($invoice_number){
      
        $detailtransactions = ProductTransaction::where('invoice_number',$invoice_number)->get();
        $transactions = Transaction::where('invoice_number',$invoice_number)->get();
      
        return view('livewire.detailTransaction', [
            'detailtransactions'=> $detailtransactions,
            'transactions'=> $transactions
        ])->with('invoice_number',$invoice_number);
    }

    public function export_excel()
	{
       
        $tglawal = $this->tglawal;
        $tglakhir = $this->tglakhir;
		return Excel::download(new TransactionExport($tglawal,$tglakhir), 'laporan-penjualan.xlsx');

	}


    public function export_pdf()
	{
     
        if($this->tglawal != null && $this->tglakhir != null){
            $transactions = Transaction::whereBetween('created_at', [$this->tglawal, $this->tglakhir])->orderBy('created_at', 'DESC')->get();
            
        }else{
            $transactions = Transaction::all();            
        }


        $pdf = PDF::loadView('export.viewTransaction',['transactions'=>$transactions])->setPaper('a4', 'landscape')->output(); //
        return response()->streamDownload(
            fn() => print($pdf), 'laporan-penjualan.pdf'
        );
    }

}
