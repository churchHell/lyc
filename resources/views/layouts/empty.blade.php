<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>LYC</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::url('apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Storage::url('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::url('favicon-16x16.png') }}">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <!-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"> -->
    <!-- <meta name="msapplication-TileColor" content="#da532c"> -->
    <meta name="theme-color" content="#ffffff">

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles
    @yield('styles')
</head>
<body class="text-xs font-sans h-screen flex flex-col relative">

@if(false)
<livewire:toasts/>
@endif

@yield('body')

@livewireScripts
@yield('scripts')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

</body>
</html>
