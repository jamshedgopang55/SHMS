{{-- 

<section class=" section-10">
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
        <div class="login-form">
            <h1>Employee Form</h1>
            <form action="{{ route('employee.authenticate') }}" method="post">
                @csrf
                <h4 class="modal-title">Login to Your Account </h4>
                <div class="form-group">
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email"
                        value="{{ old('email') }}">
                    @error('email')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror

                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Password">
                    @error('password')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror
                </div>
               
                <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
            </form>
            </div>
        </div>
    </div>
</section> --}}


{{-- <section class=" section-10">
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
        <div class="login-form">
            <form  method="post">
                @csrf
                <h4 class="modal-title">Login to Your Account</h4>
                <div class="form-group">
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email"
                        value="{{ old('email') }}">
                    @error('email')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror

                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Password">
                    @error('password')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror
                </div>
               
                <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
            </form>
            </div>
        </div>
    </div>
</section> --}}





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | Responsive Bootstrap 4 Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('/assets/css/backend-plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/backend.css?v=1.0.0')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/remixicon/fonts/remixicon.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css')}}">
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                
                    <div class="row align-items-center justify-content-center height-self-center">
                        <div class="col-lg-8">
                            <div class="card auth-card">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center auth-content">
                                        <div class="col-lg-6 bg-primary content-left">
                                            <div class="p-3">
                                                <h2 class="mb-2 text-white">Sign In</h2>
                                                <p>Login to stay connected.</p>
                                                <form action="{{ route('employee.authenticate') }}"  method="post"> 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input class="floating-input form-control"
                                                                    type="email" name="email" placeholder=" " value="{{ old('email') }}">
                                                                <label>Email</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input class="floating-input form-control" name="password" type="password" placeholder=" ">
                                                                <label>Password</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customCheck1">
                                                                <label
                                                                    class="custom-control-label control-label-1 text-white"
                                                                    for="customCheck1">Remember Me</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="auth-recoverpw.html"
                                                                class="text-white float-right">Forgot Password?</a>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-white">Sign In</button>
                                                    {{-- <p class="mt-3">
                                            Create an Account <a href="auth-sign-up.html" class="text-white text-underline">Sign Up</a>
                                         </p> --}}
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 content-right">
                                            <img src="../assets/images/login/01.png" class="img-fluid image-right"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('/assets/js/backend-bundle.min.js')}}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{asset('/assets/js/table-treeview.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{asset('/assets/js/customizer.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('/assets/js/chart-custom.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('/assets/js/slider.js')}}"></script>

    <!-- app JavaScript -->
    <script src="{{asset('/assets/js/app.js')}}"></script>

    <script src="{{asset('/assets/vendor/moment.min.js')}}"></script>
</body>

</html>
