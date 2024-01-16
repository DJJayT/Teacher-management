<!doctype html>
<html lang="{{ App::currentLocale() }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">

    <link rel="stylesheet" href="{{ asset('css/baseStyle.css') }}">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/utilities.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>

    @vite([
    'resources/js/app.js',
    'resources/sass/app.scss',
    'resources/css/Sidebar-Responsive-2-ResponsiveSideBar-2.css',
    'resources/css/Sidebar-Responsive-2.css'
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
