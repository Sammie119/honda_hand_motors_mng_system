<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/ico">
    <title>Honda Hand Motors-Management System | Login</title>
    <link href="{{ asset('public/assets/bootstrap/bootstrap_5.2.1.min.css') }}" rel="stylesheet">
  </head>

  <body>
    <section class="h-100 gradient-form" style="background-color: #E5E4E2; height: 100vh !important;">
        <div class="container py-5">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-12">
                    <div class="card-body p-1 py-4  mx-4">
      
                      <div class="text-center">
                        <img src="{{ asset('public/assets/images/honda.logo2.png') }}"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-3 pb-1">Welcome</h4>
                      </div>
      
                      <form action="login" method="POST" autocomplete="off">
                        @csrf
                        <p class="text-center">Honda Hand Motors Management System</p>
                        @if (Session::has('error'))
                          <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                          </div>
                        @endif
                        @if (Session::has('auth'))
                          <div class="alert alert-danger" role="alert">
                            {{ Session::get('auth') }}
                          </div>
                        @endif
                        <div class="form-outline form-floating mb-2">
                            <input class="form-control" name="username" type="text" required placeholder=" " autofocus>
                            <label class="form-label" for="form2Example11">Username</label>
                        </div>

                        <div class="form-outline form-floating mb-2">
                            <input type="password" id="form2Example22" name="password" class="form-control" required placeholder=" " >
                            <label class="form-label" for="form2Example22">Password</label>
                        </div>
      
                        <div class="text-center pt-2 pb-3">
                          <button class="btn btn-dark btn-block fa-lg" type="sumbit">Log in</button>
                        </div>

                        <div class="text-center pt-1 pb-2">
                            <label class="label">Sammav IT Services (0248376160/0556226864)</label>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    {{-- <script src="{{ asset('public/assets/bootstrap/bootstrap.bundle.5.2.1.min.js') }}"></script> --}}
  </body>
</html>