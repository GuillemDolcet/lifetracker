<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="16x16">

        <title>@yield('title', config('app.name'))</title>

        <meta name="csrf-param" content="_token">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('dns-prefetch')

        @stack('top-stylesheets')

        @vite(['resources/assets/stylesheets/application.scss', 'resources/assets/javascripts/application.js'], 'assets')

        @stack('top-scripts')
    </head>

    <body data-bs-theme="{{ session()->has('mode') && session()->get('mode') == 'dark' ? 'dark' : 'light' }}">
        @stack('top-content')
        @yield('main-content')
        @stack('bottom-content')
        @stack('bottom-scripts')
    </body>
</html>
