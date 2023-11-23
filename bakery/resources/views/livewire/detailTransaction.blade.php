
 <x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col">
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
                                    id Produk
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Produk
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga Produk
                                </th>
                        
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Harga per Produk
                                </th>
                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($detailtransactions as  $index=>$detail)
                     
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                    {{$index + 1}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                    {{$detail->invoice_number}}               
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{$detail->product_id}}  
                                </td>
                                @if(isset($detail->product->id))
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{$detail->product->nama}}  
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @currency($detail->product->harga)
                                </td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                                @endif
                              
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                    {{$detail->qty}}               
                                </td>

                                @if(isset($detail->product->id))
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">                
                                @currency($detail->product->harga * $detail->qty)             
                                </td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                                @endif
                               
                               
                                </tr>

                            @endforeach
                                
                            @foreach($transactions as  $index=>$transaction)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Total Harga:  
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @currency($transaction->total)
                                </td>
                            
                            @endforeach

                            </tbody>
                            </table>
                           
                        </div>
                        <div class="text-right mt-4 mr-4">
                                <a href="/transaksi">
                                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-full shadow">
                                    Kembali
                                </button>                         
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

