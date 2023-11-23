<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;

use Illuminate\Support\Facades\DB;


class Product extends Component
{

    use WithFileUploads;
    public $id_produk, $nama,$image,$harga;
    public $edit_nama, $new_image,$old_image, $edit_description, $edit_harga, $deleteId;
    public $updateMode = false;
    public $modal = false;

    public function render()
    {
        $products = ProductModel::orderBy('created_at', 'DESC')->get();
        return view('livewire.product', [

            'products' => $this->search === null ?
            ProductModel::latest()->paginate(10) : 
            ProductModel::where('nama', 'like', '%' . $this->search . '%')->latest()->paginate(10),
        ]);

    }

    use withPagination;
    protected $updatesQueryString = ['search'];
    public $search;
    private function resetInputFields(){
        $this->nama = '';
        $this->edit_nama = '';
        $this->image = '';
        $this->new_image = '';
        $this->old_image = '';
        $this->edit_description = '';
        $this->harga = '';
        $this->edit_harga = '';
    }

    public function previewImage(){
        $this->validate([
            'image' => 'image|max:2048'
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nama' => ['required', 'string'],
            'image' => ['required'],
            'harga' => ['required', 'integer'],
        ]);

        $image_name = md5($this->image . microtime()).'.'.$this->image->extension();

        $this->image->storeAs('public', $image_name);
  
        $data = [
            'nama'=>$this->nama,
            'image'=>$image_name,
            'harga'=>$this->harga,
        ];

        ProductModel::create($data);

        session()->flash('message', 'Product Created Successfully.');

        $this->resetInputFields();
        

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $product = ProductModel::where('id',$id)->first();
     
        $this->id_produk = $product->id;
        $this->edit_nama = $product->nama;
        $this->old_image = $product->image;
        $this->edit_harga = $product->harga;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update($id_produk)
    {

        $this->validate([
            'edit_nama' => ['required', 'string'],
            'new_image' => ['nullable'],
            'edit_harga' => ['required', 'integer'],
        ]);
        
        if ($this->id_produk) {
            $product = ProductModel::where('id',$id_produk)->first();
 
            if ($this->new_image != null) {
                unlink(storage_path('app/public/'.$product->image));

                $image_name = md5($this->new_image . microtime()).'.'.$this->new_image->extension();
                $this->new_image->storeAs('public', $image_name);
            }else if ($this->new_image == null){
                $image_name= $this->old_image;
            }
           
            $product->nama = $this->edit_nama;
            $product->image = $image_name;
            $product->harga = $this->edit_harga;
            $product->save();
       
            $this->updateMode = false;
            session()->flash('message', 'Data Product successfully updated.');
            $this->resetInputFields();
        }
    }


    public function delete($id)
    {
        if($id){
          
            $product = ProductModel::where('id',$id)->first();
            unlink(storage_path('app/public/'.$product->image));
            ProductModel::where('id',$id)->delete();
            session()->flash('message', 'Data Product Deleted Successfully.');
        }
    
    }


}