<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TransactionExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $tglawal;
    protected $tglakhir;

    function __construct($tglawal,$tglakhir) {
        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
       
    }

    public function query()
    {
        if($this->tglawal != null && $this->tglakhir != null){
        
            return Transaction::query()->whereBetween('created_at',[ $this->tglawal,$this->tglakhir])
            ->select('invoice_number','user_id','total','created_at')
            ->orderBy('created_at', 'DESC');
        }else{
            return Transaction::query()->select('invoice_number','user_id','total','created_at')
            ->orderBy('created_at', 'DESC');
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'invoice_number',
            'ID Kasir',
            'Total Harga',
            'Tanggal',
        ];
    }
    
}
