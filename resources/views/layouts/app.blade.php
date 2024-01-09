<!doctype html>
<html lang="{{ App::currentLocale() }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - EscapeTimez</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/utilities.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/baseStyle.css') }}">

    <meta name="color-scheme" content="dark">

    @vite([
    'resources/js/app.js',
    'resources/sass/app.scss',
    'node_modules/jquery/dist/jquery.min.js?commonjs-entry'
    ])

    @yield('extra-fonts')
    @yield('extra-css')
    @yield('sidebar-js')
    @yield('extra-js')
</head>
<body>
@include('layouts.popup')
@yield('content')
</body>
</html>
