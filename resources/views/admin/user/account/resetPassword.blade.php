
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

<body class=" ">
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
                                                <h2 class="mb-2 text-white">Reset Password</h2>
                                                {{-- <p>Login to stay connected.</p> --}}
                                                <form id="resetForm"   method="post"> 
                                                    <input type="text" name="token" hidden value="{{$token}}">
                                                    <div class="row">
                                                       
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input class="floating-input form-control" name="password" type="password" placeholder=" ">
                                                                <label>Password</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input class="floating-input form-control" name="password_confirmation" type="password" placeholder=" ">
                                                                <label>Confirm Password</label>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-white">Reset Password</button>
                                                   
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 content-right">
                                            <img src="{{asset('../assets/images/login/01.png')}}" class="img-fluid image-right"
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
<script>
    $('#resetForm').submit(function(e) {
        e.preventDefault();
        $('#btn').attr('disabled',true)
        $.ajax({
            url: "{{ route('user.processResetPassword') }}",
            type: 'post',
            data: $(this).serializeArray(),
            dataType: "json",
            success: function(response) {
                $('#btn').attr('disabled',false)
                if (response['status'] === true) {
                    window.location.href= "{{route('user.login')}}"
                } else {
                  
                    let errors = response.errors
                    console.log(errors)
                    alert('Farhan bhai erros console me aa rhy hn unko show krwao page pr ...')
                    if (errors['password']) {
                        $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password'])
                    } else {
                        $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                    }
                    if (errors['password_confirmation']) {
                        $('#password_confirmation').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password_confirmation'])
                    } else {
                        $('#password_confirmation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                    }
                }
            },
            error : function () {
                $('#wishlist_modal .modal-body').html(" <div class='alert alert-danger'>Please Check Your Internet and Try  Again</div>")
                $('#wishlist_modal').modal('show')
                $('#btn').attr('disabled', false)
            }
        })
    })
</script>
</html>
