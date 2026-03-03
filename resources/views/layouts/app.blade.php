<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen flex flex-col">
        <div class="flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="px-4 pt-6 sm:px-6 lg:px-8">
                    <div class="page-card max-w-7xl mx-auto px-4 py-5 sm:px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="site-main pb-8">
                {{ $slot }}
            </main>
        </div>
        <x-layouts.footer />
    </body>
</html>
