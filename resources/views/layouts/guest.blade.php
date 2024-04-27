<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased flex flex-col flex-wrap min-h-svh bg-gray-100 dark:bg-gray-900">
    @include('layouts.header')

    <main class="flex-1 py-12">
        {{ $slot }}
    </main>

    @include('layouts.footer')
    
    @livewireScripts
</body>

</html>