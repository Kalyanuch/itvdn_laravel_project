<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!-- Plugin file -->
    <link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css_styles')
</head>
<body>
    <div id="app">
        @include('layouts.common.navigation')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.common.footer')
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}" defer></script>
    <!-- Plugin file -->
    <script src="{{ asset('js/addons/datatables.min.js') }}" defer></script>

    <script type="text/javascript">
        new WOW().init();
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js_scripts');
</body>
</html>
