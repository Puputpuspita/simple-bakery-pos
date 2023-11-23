<div>
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
               
                    <form>
                    @csrf
                        <h2 class="text-center">Tambah Produk</h2>
                        <div class="grid lg:grid-cols-1 gap-4">
                   

                            <!-- Nama -->
                            <div>
                                <x-label for="nama" :value="__('Nama Produk')" />
                                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" wire:model="nama" :value="old('nama')" required />
                            @error('nama')
                            <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            
                            <!-- Image -->
                            <div>
                                <div class="custom-file"></div>
                                <x-label for="image" :value="__('Image')" />
                                <input type="file" class="form-control"class="block mt-1 w-full" name="image" wire:model="image" :value="old('image')"/>
                                
                                <div>
                                @error('image')
                                    <span class="text-red-500 text-sm">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                @if($image)
                                <label class="mt-2">Image Preview</label>
                                <img src="{{ $image->temporaryUrl() }}" class="object-cover w-32 h-32" alt="Preview Image">
                                @endif
                            </div>
                            
                            

                            <!-- Harga-->
                            <div class="mt-1">
                                <x-label for="harga" :value="__('Harga Produk')" />
                                <x-input id="harga" class="block mt-1 w-full" type="text" name="harga" wire:model="harga" :value="old('harga')" required />
                            @error('harga')
                            <span class="text-red-500 text-sm">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div>
                        <div class="text-right">
                        <button wire:click.prevent="store()" class="mt-4 focus:outline-none text-white text-sm sm:text-base bg-indigo-500 hover:bg-indigo-600 rounded-full py-2 w-full transition duration-150 ease-in">
                        Simpan
                        </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>