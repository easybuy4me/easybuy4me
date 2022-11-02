<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- GOOGLE WEB FONT -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap"
            as="fetch" crossorigin="anonymous">

        <!-- Favicons-->
        <link rel="shortcut icon" href="{{ asset('public/assets/img/easybuy4me.gif') }}" type="image/x-icon">

        <!-- BASE CSS -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

        <!-- SPECIFIC CSS -->
        <link href="{{ asset('public/assets/css/home.css') }}" rel="stylesheet">

        <link href="{{ asset('public/assets/css/tailwind.output.css') }}" rel="stylesheet">

        @viteReactRefresh
        @vite('resources/js/app.js')
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
