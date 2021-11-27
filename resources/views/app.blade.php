<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/nucleo/css/nucleo.css')}}">
        <link rel="stylesheet" href="{{asset('css/@fortawesome/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/argon.css')}}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-default">
        @inertia

        <script src="{{asset("js/vendor/jquery.min.js") }}"></script>
        <script src="{{asset("js/vendor/bootstrap.bundle.min.js") }}"></script>
        <script src="{{asset("js/vendor/js.cookie.js") }}"></script>
        <script src="{{asset("js/vendor/jquery.scrollbar.min.js") }}"></script>
        <script src="{{asset("js/vendor/jquery-scrollLock.min.js") }}"></script>
        <script src="{{asset("js/vendor/Chart.min.js") }}"></script>
        <script src="{{asset("js/vendor/Chart.extension.js") }}"></script>
        <script src="{{asset("js/vendor/argon.js?v=1.2.0") }}"></script>
    </body>
</html>
