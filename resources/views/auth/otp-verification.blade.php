<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>KFUEIT Digital Wallet | OTP Verification</title>
    <meta content="Admin Dashboard" name="KFUEIT" />
    <meta content="ICT Department" name="KFUEIT" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App Icons -->
    <link rel="shortcut icon" href="https://kfueit.edu.pk/vendor/core/images/favicon.png">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/global_assets/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('master-demo/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>
<body class="hold-transition login-page" style="background:url('{{asset("master-demo/images/kfueit_background_image.jpg")}}');background-attachment: fixed;background-size: 100% auto;background-repeat: no-repeat;'">
<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>
<!-- Page content -->
<div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            <!-- Login form -->
            <div class="card" style="width: 380px;">
                <div class="card-body">
                    <h3 class="text-center" style="margin-top: 50px;">
                        <a href="/" class="logo logo-admin"><img src="https://kfueit.edu.pk/uploads/4/ueit-logo-r.png" height="70" alt="logo"></a>
                    </h3>
                    <div class="p-3">
                        <h4 class="font-18 m-b-5 text-center">Welcome !</h4>
                        <p class="text-muted text-center">OTP Login to continue Dashboard.</p>
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong>  {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong>  {{ Session::get('error') }}
                            </div>
                        @endif
                        @if(Session::has('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong>  {{ Session::get('warning') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('otp') }}">
                            @csrf
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus placeholder="Enter OTP">
                                <div class="form-control-feedback">
                                    <i class="icon-key text-muted"></i>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /login form -->

            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->

    </div>
</div>
<!-- /page content -->
<!-- Core JS files -->

{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('OTP Login') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if (session('success'))--}}
{{--                            <div class="alert alert-success" role="alert"> {{session('success')}}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        @if (session('error'))--}}
{{--                            <div class="alert alert-danger" role="alert"> {{session('error')}}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <form method="POST" action="{{ route('otp.login') }}">--}}
{{--                            @csrf--}}
{{--                            <div class="row mb-3">--}}
{{--                                <label for="mobile_no" class="col-md-4 col-form-label text-md-end">{{ __('OTP') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus placeholder="Enter OTP">--}}

{{--                                    @error('otp')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                            <div class="row mb-0">--}}
{{--                                <div class="col-md-8 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        {{ __('Login') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Core JS files -->
    <script src="{{ asset('master-demo/global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{ asset('master-demo/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('master-demo/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->
    <!-- App js -->
    <script src="{{ asset('master-demo/assets/js/app.js')}}"></script>

</body>
</html>
