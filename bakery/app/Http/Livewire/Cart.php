<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use App\Models\ProductTransaction;

use Carbon\Carbon;
use Livewire\WithPagination;
use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PDF;


class Cart extends Component
{
    public $tax = "0%";
    public $payment = 0;
    public $invoice_number = '';

    public function render()
    {
        $products = ProductModel::orderBy('created_at', 'DESC')->get();

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
            'order' => 1
        ]);
        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart){
            return $cart->attributes->get('added_at');
        });

        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach($items as $item){
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();
        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);
        
        $summary = [
            'total' => $total
        ];

        return view('livewire.cart',[
            // 'products' => $products,
            'products' => $this->search === null ?
            ProductModel::latest()->paginate(10) : 
            ProductModel::where('nama', 'like', '%' . $this->search . '%')->latest()->paginate(10),
            'carts' => $cartData,
            'summary' => $summary
        ]);
    }
    use withPagination;
    protected $updatesQueryString = ['search'];
    public $search;
    
    public function addItem($id){
        $rowId = "Cart".$id;
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        if($cekItemId->isNotEmpty()){
            \Cart::session(Auth()->id())->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }else{
            $product = ProductModel::findOrFail($id);
            \Cart::session(Auth()->id())->add([
                'id' => "Cart".$product->id,
                'name' => $product->nama,
                'price' => $product->harga,
                'quantity' => 1,
                'attributes' => [
                    'added_at' => Carbon::now()
                ],
            ]);
        }
    
    }

    public function increaseItem($rowId){
      
        \Cart::session(Auth()->id())->update($rowId, [
            'quantity' => [
                'relative' => true,
                'value' => 1
            ]
        ]);
    }

    public function decreaseItem($rowId){
      
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItem = $cart->whereIn('id', $rowId);

        if($cekItem[$rowId]->quantity == 1){
            \Cart::session(Auth()->id())->remove($rowId);
        }else{
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
        }
        
    }

    
    public function removeItem($rowId){
      
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function handleSubmit(){
        $cartTotal = \Cart::session(Auth()->id())->getTotal();
        $bayar = $this->payment;
        $kembalian = (int) $bayar - (int) $cartTotal;

        if($kembalian >= 0){
            DB::beginTransaction();
            try{
                $allCart = \Cart::session(Auth()->id())->getContent();

                $filterCart = $allCart->map(function ($item) {
                    return [
                        'id' => substr($item->id, 4, 5),
                        'quantity' => $item->quantity
                    ];
                });

                $id = IdGenerator::generate([
                    'table' => 'transactions',
                    'length' => 10,
                    'prefix' => 'INV_',
                    'field' => 'invoice_number'
                ]);

                Transaction::create([
                    'invoice_number' => $id,
                    'user_id' => Auth()->id(),
                    'pay' => $bayar,
                    'total' => $cartTotal,
                    'kembalian' => $kembalian,
                ]);

                foreach ($filterCart as $cart){
                    ProductTransaction::create([
                        'product_id' => $cart['id'],
                        'invoice_number' => $id,
                        'qty' => $cart['quantity']
                    ]);
                }

                \Cart::session(Auth()->id())->clear();
                $this->payment = 0;

                DB::commit();

                session()->flash('message', 'Data Transaction Saved Successfully.');
                
            } catch (\Throwable $th) {
                DB::rollback();
            }
        }
    }
}
