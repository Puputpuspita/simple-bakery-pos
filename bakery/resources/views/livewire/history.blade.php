<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="grid md:grid-cols-3 sm:grid-cols-1">
                    <div class="mb-2">
                    <x-label for="tglawal" :value="__('Tanggal Awal:')" class="inline mr-4"/>
                    <input 
                        wire:model="tglawal"
                        type="date" class="form-control datepicker" placeholder="Tanggal Awal" 
                        autocomplete="off"
                        data-provide="datepicker" data-date-autoclose="true" 
                        data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
                        onchange="this.dispatchEvent(new InputEvent('input'))"
                    >
                    </div>
                    <div class="mb-2">
                    <x-label for="tglakhir" :value="__('Tanggal Akhir:')" class="inline mr-4" />
                    <input 
                        wire:model="tglakhir"
                        type="date" class="form-control datepicker" placeholder="Tanggal Akhir" 
                        autocomplete="off"
                        data-provide="datepicker" data-date-autoclose="true" 
                        data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
                        onchange="this.dispatchEvent(new InputEvent('input'))"
                    >
                    </div>
                    <div>Download Laporan:
               
                        <button wire:click="export_excel" class="ml-4 bg-green-500 px-4 py-2 rounded text-white transition duration-150 ease-in hover:bg-green-600">
                        <img class="w-6 h-6 inline" src="https://img.icons8.com/color/96/000000/export-excel.png"/>
                            Excel
                        </button>
                  
                        <button wire:click="export_pdf" class="ml-4 bg-red-400 px-4 py-2 rounded text-white transition duration-150 ease-in hover:bg-red-500">
                        <img class="w-6 h-6 inline" src="https://img.icons8.com/office/80/000000/export-pdf.png"/>
                            PDF
                        </button>

                    </div>
            </div>
                <div class="flex flex-col mt-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Invoice Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID Kasir
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kasir
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Harga
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Detail</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transactions as  $index=>$transaction)
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                    {{$index + 1}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                    {{$transaction->invoice_number}}               
                                </td>
                                @if(isset($transaction->user->id))
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{$transaction->user_id}}  
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{$transaction->user->name}}  
                                </td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @currency($transaction->total)
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{$transaction->created_at}}  
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="/transaksi/detail/{{ $transaction->invoice_number }}" class="underline hover:text-indigo-600">Details</a>
                                </td>
                                </tr>

                                @endforeach
                            
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                <br>
                {{ $transactions->links() }}      
            </div>
        </div>
    </div>
</div>
