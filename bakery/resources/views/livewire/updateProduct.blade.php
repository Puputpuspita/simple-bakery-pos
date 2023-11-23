<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
                
            <div class="container mx-auto">
                

            @if (session()->has('message'))
                 <div class="bg-green-100 rounded-md p-3 flex">
                        <svg
                            class="stroke-2 stroke-current text-green-600 h-6 w-6 mr-2 flex-shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                        >
                            <path d="M0 0h24v24H0z" stroke="none" />
                            <circle cx="12" cy="12" r="9" />
                            <path d="M9 12l2 2 4-4" />
                        </svg>

                        <div class="text-green-700">
                            <div class="font-bold text-md">  {{ session('message') }}</div>
                        </div>
                    </div>
                    <br>
            @endif

                <form enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Update Produk</h2>
                        <div class="grid lg:grid-cols-1 gap-4">

                            <div>
                                <x-label for="id_produk" :value="__('Id Produk')" />
                                <x-input id="id_produk" class="block mt-1 w-full" type="text" name="id_produk" wire:model="id_produk" :value="old('id_produk')" required readonly/>
                            @error('id_produk')
                            <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <!-- Name -->
                            <div>
                                <x-label for="nama" :value="__('Nama Produk')" />
                                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" wire:model="edit_nama" :value="old('nama')" required autofocus/>
                            @error('nama')
                            <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            
                            <!-- Image -->
                            <div>
                                <div class="custom-file"></div>
                                <x-label for="new_image" :value="__('Image')" />
                                <input type="file" class="form-control"class="block mt-1 w-full" name="new_image" wire:model="new_image"/>
                            <div>
                                <div>
                                @error('new_image')
                                <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                        
                                @if($new_image)
                                <label class="mt-2">Image Preview</label>
                                <img src="{{ $new_image->temporaryUrl() }}" class="object-cover w-32 h-32" alt="Preview Image">
                                @endif
                            </div>

                                    
                            <!-- Harga-->
                            <div class="mt-5">
                                <x-label for="edit_harga" :value="__('Harga Produk')" />
                                <x-input id="edit_harga" class="block mt-1 w-full" type="text" name="harga" wire:model="edit_harga" :value="old('harga')" required />
                            @error('edit_harga')
                            <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            

                        </div>
                        <div>
                            <button wire:click.prevent="update({{ $id_produk }})" class="focus:outline-none text-white text-sm sm:text-base bg-indigo-500 hover:bg-indigo-600 rounded-full py-2 w-full transition duration-150 ease-in">
                            Simpan
                            </button>
                        </div>
                        <div>
                            <button wire:click.prevent="cancel()" class="focus:outline-none text-indigo-500 text-sm sm:text-base bg-white border border-indigo-500 hover:bg-indigo-100 hover:text-indigo-600 rounded-full py-2 w-full transition duration-150 ease-in">Batal</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>