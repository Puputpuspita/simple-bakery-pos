<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-3 mx-auto">
                        <h1 class="sm:text-3xl text-center text-2xl font-medium title-font mb-4 text-gray-900">Welcome!</h1>
                        <div class="flex flex-wrap -m-4 text-center pl-10 pr-10">

                        <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                            <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-900">{{$totalProduk}}</h2>
                            <p class="leading-relaxed">Produk</p>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-900">{{$totalOrder}}</h2>
                            <p class="leading-relaxed">Order hari ini</p>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-900">@currency($totalPenjualan)</h2>
                            <p class="leading-relaxed">Penjualan hari ini</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
                 <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="flex flex-col pl-10 pr-10">
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                            <div class="w-24 h-full bg-indigo-500"></div>
                        </div>
                        <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-4">
                            <h1 class="sm:w-2/5 text-gray-900 font-medium title-font text-2xl sm:mb-0">Chart Penjualan</h1>
                        </div>
                        </div>
                        <div class="p-0 sm:pl-10">
                            <h1>{{ $chart3->options['chart_title'] }}</h1>
                                {!! $chart3->renderHtml() !!}

                                @section('javascript')
                                    {!! $chart3->renderChartJsLibrary() !!}
                                    {!! $chart3->renderJs() !!}
                                @endsection
                            </div>
                        </div>
                  
                    </div>
                </section>
                
                <section class="text-gray-600 body-font pl-10 pr-10">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="flex flex-col">
                        <div class="h-1 bg-gray-200 rounded overflow-hidden">
                            <div class="w-24 h-full bg-indigo-500"></div>
                        </div>
                        <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
                            <h1 class="sm:w-2/5 text-gray-900 font-medium title-font text-2xl mb-2 sm:mb-0">Top 3 Produk</h1>
                        </div>
                        </div>
                        <div class="flex flex-wrap flex-col md:flex-row sm:-m-4 -mx-4 -mb-10 -mt-4">
                        @foreach($top_produk as $top)
                            @if(isset($top->nama))
                     
                            <div class="p-4 md:w-1/4 sm:w-full sm:mb-0 mb-6 rounded-lg border border-gray-200 shadow-md ml-4 mr-4">
                                <div class="rounded-lg h-48 overflow-hidden">
                                <img alt="content" class="object-cover object-center h-full w-full" src="{{ asset('storage') }}/{{ $top->image}}">
                                </div>
                                <h2 class="text-xl font-medium title-font text-gray-900 mt-5">{{ $top->nama }}</h2>
                                <p class="text-base leading-relaxed mt-2"> @currency($top->harga) </p>
                                </a>
                            </div>
                            @else
                            @endif
                        @endforeach
                  
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
