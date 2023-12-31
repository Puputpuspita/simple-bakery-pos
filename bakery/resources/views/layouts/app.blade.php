<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Geulis Cake</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <style>
            * {
                font-family: 'Nunito', sans-serif;
            }
        </style>
      
        @livewireStyles
    </head>
    <body class="antialiased">
        <div class="min-h-screen" style="background-color: #f1f4fb">
      
            @include('layouts.navigation')

            @isset($header)
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <!-- Page Content -->
            <main>
                @isset($slot)
                {{ $slot }}
                @endisset
            </main>
            @yield('javascript')
        </div>
        @livewireScripts
        @stack('script-custom')
    </body>
</html>
