<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود به سامانه</title>
    <link rel="stylesheet"
          href="{{ URL::asset('login_page/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet"
          href="{{ URL::asset('css/icons/icomoon/styles.css') }}" type="text/css">
    <link rel="stylesheet"
          href="{{ URL::asset('login_page/custom.css') }}" type="text/css">
    <link rel="stylesheet"
          href="{{ URL::asset('css/toastr.min.css') }}" type="text/css">

</head>

<body class="login-container login-cover ">
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- اصلی content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content pb-20">
                <!-- Tabbed form -->
                <div class="tabbable panel login-form width-400">

                    <div class="tab-content panel-body">
                        <div class="tab-pane fade in active" id="basic-tab1">
                            <form method="post" action="{{ route('login') }}" id="loginForm">
                                @csrf
                                <div class="text-center">
                                    <div class="">
                                        <img width="250" height="320"
                                             src="{{ asset('login_page/Seemorgh-Logo-purple.png') }}"
                                             alt="">
                                    </div>
                                    <h5 style="color: teal" class="content-group"><b>ورود به سامانه</b><br><small
                                            style="font-size: 11px; color: #009688;">سایت آمار سیمرغ سامانه</small>
                                    </h5>
                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i style="color: teal" class="icon-user"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="شماره همراه" name="phone"
                                               id="phone"
                                               tabindex="1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i style="color: teal" class="icon-lock2"></i>
                                        </div>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" tabindex="2" autocomplete="current-password"
                                               placeholder="کلمه عبور">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn bg-teal btn-block" type="submit">
                                        ورود <i class="m-icon-swapright m-icon-white"></i>
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('مرا به خاطر بسپار') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="content-divider text-muted form-group"><span></span></div>
                        </div>
                    </div>
                </div>
                <!-- /tabbed form -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<script type="text/javascript"
        src="{{ URL::asset('login_page/jquery-2.1.3.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('js/toastr.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        @error('phone')
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": 1
        }
        Command: toastr["error"]("{{ $message }}", "");
        @enderror

            @error('password')
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": 1
        }
        Command: toastr["error"]("{{ $message }}", "");
        @enderror

            @if (session('error'))
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": 1
        }
        Command: toastr["error"]("{{ session('error') }}", "");
        @endif

    });

</script>
</body>
</html>
