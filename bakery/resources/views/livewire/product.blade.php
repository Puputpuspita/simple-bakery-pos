
<div class="container flex flex-wrap flex-col md:flex-row sm:flex-col-reverse m-5 justify-evenly mx-auto">
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
                <p class="mt-1 text-sm">@currency($product->harga) </p>
                <div class="text-right">
                    <button wire:click="edit({{ $product->id }})" title="Edit produk" class="rounded transform hover:text-blue-500 hover:scale-110">
                        <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>

                    <button class="rounded transform hover:text-red-500 hover:scale-110 inline ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id-{{ $product->id }}')">
                        <svg class="w-4 mt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 bg-gray-500 bg-opacity-50 outline-none focus:outline-none justify-center items-center" id="modal-id-{{ $product->id }}">
                    <div class="relative w-auto my-44 mx-auto max-w-lg justify-center">
                        <!--content-->
                        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                        <!--header-->
                        <div class="flex items-start justify-between p-4 border-b border-solid border-blueGray-200 rounded-t">
                            <svg class="h-10 w-10 text-red-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-2xl font-semibold ml-4 mt-1">
                                Hapus Data Produk 
                            </h3>
                            <button class="p-1 ml-auto border-0 text-black text-xl font-bold float-right leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id-{{ $product->id }}')">
                            <span>
                                ×
                            </span>
                            </button>
                        </div>
                        <!--body-->
                        <div class="relative p-4 flex-auto text-left">
                            <p class="mt-4 text-blueGray-500 text-lg leading-relaxed">
                                Apakah anda yakin ingin menghapus data produk ini? 
                            </p>
                            <p class="mt-0 text-blueGray-500 text-lg leading-relaxed">
                                Data produk akan dihapus secara permanen.
                            </p>
                        </div>
                        <!--footer-->
                        <div class="flex bg-gray-50 items-center justify-center p-4 rounded-b">
                            <button class="bg-white hover:bg-gray-100 text-gray-800 border border-gray-400 rounded-full shadow font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id-{{ $product->id }}')">
                            Tidak
                            </button>
                            <button  wire:click="delete({{ $product->id }})" class="bg-red-500 hover:bg-red-600 shadow text-white active:bg-red-600 font-bold uppercase text-sm px-9 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id-{{ $product->id }}')">
                            Ya
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
                    <script type="text/javascript">
                        function toggleModal(modalID){
                            document.getElementById(modalID).classList.toggle("hidden");
                            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
                            document.getElementById(modalID).classList.toggle("flex");
                            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
                        }
                    </script>

                 
                </div>
            </div>
        @endforeach


     
        </div>
        <br>
        {{ $products->links() }}    

    </div>

    <div class="basis-2/5 mt-2">
        @if($updateMode)
            @include('livewire.updateProduct')
        @else
            @include('livewire.createProduct')
        @endif
    </div>
   
</div>

