<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')-{{ config('app.name', 'Blogsite') }}</title>

    <!-- Stylesheets -->

    <link href="{{ asset('user/frontend/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('user/frontend/css/swiper.css') }} " rel="stylesheet">

    <link href="{{ asset('user/frontend/css/ionicons.css') }}" rel="stylesheet">


    @stack('css')

</head>
<body>

@include('frontend.partial.header')

    @yield('content')

@include('frontend.partial.footer')


    <!-- SCIPTS -->

    <script src=" {{ asset('user/frontend/js/jquery-3.1.1.min.js') }} "></script>

    <script src="{{ asset('user/frontend/js/tether.min.js') }} "></script>

    <script src="{{ asset('user/frontend/js/bootstrap.js') }} "></script>

    <script src="{{ asset('user/frontend/js/scripts.js') }} "></script>

    <script src="{{ asset('user/frontend/js/swiper.js') }} "></script>

    @stack('js')

</body>
</html>
