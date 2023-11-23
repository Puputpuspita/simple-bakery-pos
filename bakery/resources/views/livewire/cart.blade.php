<div class="container flex flex-wrap flex-col md:flex-row sm:flex-col-reverse m-5 justify-evenly mx-auto">
          
    @if (session()->has('message'))

    <div class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 bg-gray-500 bg-opacity-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
    <div class="relative w-auto my-44 mx-auto max-w-lg justify-center">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="p-5">
            <h3 class="inline text-xl font-semibold ml-4 mt-1">
            <svg
            class="inline stroke-2 stroke-current text-green-600 h-10 w-10 mr-2 text-center flex-shrink-0"
            viewBox="0 0 24 24"
            fill="none"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <path d="M0 0h24v24H0z" stroke="none" />
            <circle cx="12" cy="12" r="9" />
            <path d="M9 12l2 2 4-4" />
            </svg>
            {{ session('message') }}
            </h3>
            </div>
        <!--footer-->
        <div class="flex bg-gray-50 items-center justify-center p-2 rounded-b mt-4">
            <button class="bg-white hover:bg-gray-100 text-gray-800 border border-gray-400 rounded-full shadow font-bold uppercase px-6 py-3 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" wire:click="render()">
            Kembali
            </button>
            <button class="bg-indigo-500 text-white active:bg-indigo-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" wire:click="render()">
            <a href="/cetak_struk" target="_blank">Cetak Struk</a>
            <button>
        </div>
        </div>
    </div>
    </div>
    @endif


    <div class="basis-3/5 mt-2">
        <div class="relative mx-auto text-gray-600">
            <input class="border-1 border-gray-300 bg-white h-10 w-full rounded-2xl text-sm focus:outline-none mb-4"
            type="search" wire:model="search" name="search" placeholder="Search">
            <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                width="512px" height="512px">
                <path
                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-4 2xl:grid-cols-4">
        @foreach($products as $product)
            <div class="p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <img alt="images" class="object-cover object-center w-48 h-32" src="{{ asset('storage') }}/{{ $product->image}}">

                <h3 class="text-gray-900 title-font font-bold text-md font-medium mt-3 w-48">{{$product->nama}}</h3>
                <p class="mt-1 text-sm">@currency($product->harga)</p>
                <button wire:click="addItem({{ $product->id }})"class="mt-3 focus:outline-none text-indigo-500 text-sm sm:text-base bg-white border border-indigo-500 hover:bg-indigo-100 hover:text-indigo-600 rounded-full py-2 w-full transition duration-150 ease-in">
                    Beli
                </button>
            </div>
        @endforeach
        </div>
        <br>
        {{ $products->links() }}  
    </div>

    <div class="basis-2/5 mt-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <div class="container mx-auto">

                    <h2 class="text-gray-900 title-font text-lg font-medium">Cart</h2><hr>
                    <table class="table-fixed divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col" class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Qty
                            </th>
                            <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </th>
                            <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($carts as $index=>$cart)
                            <tr>
                                <td class="px-2 py-3 whitespace-nowrap text-sm text-gray-900">{{$index + 1}}</td>
                                <td class="px-2 py-3 whitespace-nowrap text-sm text-gray-900">{{$cart['name']}}</td>
                                <td class="px-2 py-3 whitespace-nowrap text-sm text-gray-900">
                                     
                                    <button wire:click="decreaseItem('{{ $cart['rowId'] }}')"class="ml-1 font-bold focus:outline-none text-sm sm:text-base bg-white border border-gray-300 w-7 hover:bg-red-400 hover:text-white border-8 rounded-full transition duration-150 ease-in">
                                        -
                                    </button>
                                    {{$cart['qty']}}
                                    <button wire:click="increaseItem('{{ $cart['rowId'] }}')"class="mr-1 font-bold focus:outline-none text-sm sm:text-base bg-white border border-gray-300 w-7 hover:bg-indigo-400 hover:text-white border-8 rounded-full transition duration-150 ease-in">
                                        +
                                    </button>
                           
                                </td>
                                <td class="px-2 py-3 whitespace-nowrap text-sm text-gray-900">@currency($cart['price'])</td>
                                <td>
                                    <button wire:click="removeItem('{{ $cart['rowId'] }}')" class="rounded transform hover:text-red-500 hover:scale-110">
                                        <svg class="w-4 mt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg> 
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <td></td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">empty cart</td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                    <!-- Cart Summary -->
                    <hr>
                    <div class="grid grid-cols-2">
                        <p class="font-bold mt-4">
                            Total   :
                        </p>
                        <p class="font-bold mt-4 text-right">
                            @currency($summary['total'])
                        </p>
                    </div>
                    </div>
                    <div class="mt-4">
                        <input type="number" wire:model="payment" class="form-control border-1 border-gray-300 bg-white h-10 w-full rounded-2xl text-sm focus:outline-none" id="payment" placeholder="Input customer payment amount">
                        <input type="hidden" id="total" value="{{$summary['total']}}">
                    </div>
                    <form wire:submit.prevent="handleSubmit">
                        <div class="mt-3 grid grid-cols-2">
                            <label class="inline">Pembayaran:</label>
                            <p id="paymentText" wire:ignore class="inline text-right">Rp 0</p>
                        </div>
                        <div class="mt-2 grid grid-cols-2">
                            <label class="inline">Kembalian:</label>
                            <p id="kembalianText" wire:ignore class="inline text-right">Rp 0</p>
                        </div>
                        <button wire:ignore type="submit" id="saveButton" class="mt-4 disabled:opacity-75 focus:outline-none text-white text-sm sm:text-base bg-indigo-500 hover:bg-indigo-600 rounded-full py-2 w-full transition duration-150 ease-in">
                            Simpan Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('script-custom')
    <script>
        payment.oninput = () =>{
            const paymentAmount = document.getElementById("payment").value
            const totalAmount = document.getElementById("total").value
            
            const kembalian = paymentAmount - totalAmount

            document.getElementById("kembalianText").innerHTML = `Rp ${rupiah(kembalian)}`
            document.getElementById("paymentText").innerHTML = `Rp ${rupiah(paymentAmount)}`

            const saveButton = document.getElementById("saveButton")

            if(kembalian < 0){
                saveButton.disabled = true
            }else{
                saveButton.disabled = false
            }
        }

        const rupiah = (angka) => {
  
            if(angka > 0){
                const numberString = angka.toString()
                const split = numberString.split(',')
                const sisa = split[0].length % 3
                let rupiah = split[0].substr(0, sisa)
                const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)

                if(ribuan){
                    const separator = sisa ? '.' : ''
                    rupiah += separator + ribuan.join('.')
                }
                return split[1] != undefined ? rupiah + ',' + split[1] : rupiah 
            }else{
                return angka;
            }


        }
    </script>
@endpush