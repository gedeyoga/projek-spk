<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="logo/logo.jpeg" width="100" height="100" alt="logo">
            <h3 class="mt-2">Kidz Cafe Sanur</h3>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <form id="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group is-invalid">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3 is-invalid">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Sign Up</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/public.js') }}"></script>
    <script>
        $("#auth-form").submit(function(e) {
            e.preventDefault();
            $('#auth-form input').removeClass('is-invalid');

            $.ajax({
                type: "POST",
                data: $(this).serialize(),
                url: "{{ route('login') }}",
                beforeSend: function() {
                    Swal.showLoading()
                },
                success: function(response) {
                    Swal.fire(
                        'Pemberitahuan',
                        'Login Berhasil',
                        'success'
                    );

                    window.location.href = '{{ route("home") }}';
                },
                error: function(err) {
                    $('#auth-form .invalid-feedback').remove();
                    Swal.close();
                    for (const key in err.responseJSON.errors) {


                        $('#auth-form input[name="' + key + '"]').addClass('is-invalid');
                        $('#auth-form select[name="' + key + '"]').addClass('is-invalid');
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter($('#auth-form input[name="' + key + '"]').parent());
                        $('<div class="invalid-feedback">' + err.responseJSON.errors[key][0] + '</div>').insertAfter($('#auth-form select[name="' + key + '"]').parent());
                    }
                }
            });
        });
    </script>

</body>

</html>
