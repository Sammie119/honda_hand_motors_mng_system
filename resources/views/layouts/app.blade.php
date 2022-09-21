
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Sammav IT Services">
        <meta name="generator" content="Hugo 0.101.0">
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/ico">

        <link href="{{ asset('public/assets/bootstrap/bootstrap_5.2.1.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">

    </head>
    <body class="bg-light">
        
        @include('layouts.navbar')

        <main class="container">

            @yield('content')
            
        </main>


        <script src="{{ asset('public/assets/bootstrap/bootstrap.bundle.5.2.1.min.js') }}"></script>

        <script>
            (() => {
                'use strict'

                document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
                document.querySelector('.offcanvas-collapse').classList.toggle('open')
                })
            })()
        </script>
    </body>
</html>
