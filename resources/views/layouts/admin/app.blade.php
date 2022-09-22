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
    <link href="{{ asset('public/assets/css/dashboard.style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/js/alert/toastr_alert.css') }}">


  </head>
  <body>
    
    @include('layouts.admin.nav-bar')

    <div class="container-fluid">
      <div class="row">
        
        @include('layouts.admin.sidebar')

        @yield('content')
        
      </div>
    </div>

    @include('modals.user_profile')

    <script src="{{ asset('public/assets/bootstrap/bootstrap.bundle.5.2.1.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/alert/toastr_alert.js') }}"></script>

    <script>
      $(document).on('click', '.profile', function(){
          $('.modal-title').text('User Profile');

          // var editModal=<?=Auth()->user()->user_id?>;
          $.get('create-modal/user_profile', function(result) {
              
              $(".modal-body").html(result);
              
          })
      });
    </script>

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

  </body>
</html>
