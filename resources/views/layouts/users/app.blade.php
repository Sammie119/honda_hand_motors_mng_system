
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Sammav IT Services">
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/ico">

        <link href="{{ asset('public/assets/bootstrap/bootstrap_5.2.1.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/js/alert/toastr_alert.css') }}">

    </head>
    <body class="bg-light">
        
        @include('layouts.users.navbar')

        <main class="container">

            @yield('content')
            
        </main>


        <script src="{{ asset('public/assets/bootstrap/bootstrap.bundle.5.2.1.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/alert/toastr_alert.js') }}"></script>

        @stack('scripts')

        @if(Session::has('success'))
            <script>
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                toastr.success("{!! Session::get('success') !!}");
            </script>
        @endif

        @if(Session::has('error'))
            <script>
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                toastr.error("{!! Session::get('error') !!}");
            </script>
        @endif

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