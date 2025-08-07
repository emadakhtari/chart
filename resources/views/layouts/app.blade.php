<?php

use App\Models\User;

if (Auth::user()) {
    $user = User::where('id', Auth::user()->id)->first();
    $userRole = User::where('id', Auth::user()->id)->with('roles')->first();
}

?>

    <!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="{{asset('assets/vendors/bundle.css')}}" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::toastr -->
    <link rel="stylesheet"
          href="{{ URL::asset('css/toastr.min.css') }}" type="text/css">
    <!-- end::toastr -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{asset('assets/media/image/favicon.png')}}">
    <!-- end::favicon -->

@yield('styles')

<!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->

</head>
<body>

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        @if (Auth::user())
            <ul>
                <li><a class="active" href="{{route('home')}}"><i class="icon ti-home"></i> <span>داشبورد</span> </a>
                </li>
                @if(Auth::user()->hasPermissionTo('Administer roles & permissions') || Auth::user()->id == 1 || Auth::user()->id == 2)
                    <li class="side-menu-divider">مدیریت دسترسی ها</li>
                    <li class="permissionsRoot"><a href="#"><i class="icon ti-key"></i> <span>مجوز ها</span> </a>
                        <ul>
                            <li class="permissionsParent">
                                <a href="#">مجوز</a>
                                <ul>
                                    <li><a class="permissionsCreate" href="{{route('permissions.create')}}">ایجاد
                                            مجوز</a>
                                    </li>
                                    <li><a class="permissionsList" href="{{route('permissions.index')}}">لیست مجوز
                                            ها</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="rolesParent"><a href="#">نقش ها</a>
                                <ul>
                                    <li><a class="rolesCreate" href="{{route('roles.create')}}">ایجاد نقش </a></li>
                                    <li><a class="rolesList" href="{{route('roles.index')}}">لیست نقش ها</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="usersRoot"><a href="#"><i class="icon ti-face-smile"></i> <span>کاربران</span> </a>
                        <ul>
                            <li><a class="usersCreate" href="{{route('users.create')}}">ایجاد کاربر</a></li>
                            <li><a class="usersList" href="{{route('users.index')}}">لیست کاربران</a></li>
                        </ul>
                    </li>
                @endif
                <li class="side-menu-divider">مدیریت قابلیت ها</li>

                <li class="chartCategoriesRoot"><a href="#"><i class="icon ti-pie-chart"></i> <span>نمودار ها</span>
                    </a>
                    <ul>
                        <li class="chartCategoriesParent">
                            <a href="#">دستبندی ها</a>
                            <ul>

                                @can('Create ChartCategories')
                                    <li>
                                        <a class="chartCategoriesCreate"
                                           href="{{route('chartCategories.create')}}">ایجاد</a>
                                    </li>
                                @else
                                    <li style="opacity: .5;">
                                        <a class="chartCategoriesCreate"
                                           href="{{route('chartCategories.create')}}">ایجاد</a>
                                    </li>
                                @endcan

                                <li>
                                    <a class="chartCategoriesList" href="{{route('chartCategories.index')}}">لیست</a>
                                </li>
                            </ul>
                        </li>
                        <li class="chartsParent"><a href="#">نمودار ها</a>
                            <ul>
                                @can('Create Charts')
                                    <li><a class="chartsCreate" href="{{route('charts.create')}}">ایجاد</a></li>
                                    <li><a class="chartsCreateImport" href="{{route('charts.create_import')}}">ایجاد (Excel)</a></li>
                                @else
                                    <li style="opacity: .5;"><a class="chartsCreate" href="{{route('charts.create')}}">ایجاد</a>
                                    </li>
                                @endcan
                                <li><a class="chartsList" href="{{route('charts.index')}}">لیست</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="clientsRoot"><a href="#"><i class="icon ti-user"></i> <span>مصرف کنندگان</span>
                    </a>
                    <ul>

                        @can('Create Clients')
                            <li>
                                <a class="clientsCreate"
                                   href="{{route('clients.create')}}">ایجاد</a>
                            </li>
                        @else
                            <li style="opacity: .5;">
                                <a class="clientsCreate"
                                   href="{{route('clients.create')}}">ایجاد</a>
                            </li>
                        @endcan

                        <li>
                            <a class="clientsList" href="{{route('clients.index')}}">لیست</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
    </div>
</div>
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="{{ route('home') }}">
                <img src="{{asset('assets/media/image/SHOA-logo.png')}}" alt="...">
                <span class="logo-text d-none d-lg-block">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>


        <div class="header-body">

            <div class="search" style="width: 100%;">
                @if (Auth::user())
                    <div class="input-group">
                        <h5 class="text-white text-center" style="margin: 0 auto;display: inline-block;">کاربر گرامی، <b
                                style="color: #20c997">{{ Auth::user()->name }}</b> عزیز، خوش آمدید.</h5>
                        <small class="text-white text-center ml-3">نوع دسترسی :
                            @if(Auth::user()->id == 1)
                                <b style="font-size: 13px">مدیر کل سامانه</b>
                            @else
                                <b style="font-size: 13px">{{$userRole->roles->first()->name}}</b>
                            @endif
                        </small>
                    </div>
                @endif
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown">
                        <figure class="avatar avatar-sm avatar-state-success">
                            @isset($user)
                                @if($user->avatar)
                                    <img src="{{asset('data/users').'/'.$user->avatar}}" alt="...">
                                @else
                                    <img src="{{asset('assets/media/image/avatar.png')}}" alt="...">
                                @endif
                            @endisset
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{--                        <a href="#" class="dropdown-item">پروفایل</a>--}}
                        {{--                        <a href="#" class="dropdown-item">تنظیمات</a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="text-danger dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('خروج') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item d-lg-none d-sm-block">
                    <a href="#" class="nav-link side-menu-open">
                        <i class="ti-menu"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end::navbar -->

<!-- begin::main content -->
<main class="main-content">
    <div class="container-fluid">
        @yield('content')
    </div>
</main>
<!-- end::main content -->

<!-- begin::global scripts -->
<script type="text/javascript"
        src="{{asset('assets/vendors/bundle.js')}}"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script type="text/javascript"
        src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript"
        src="{{asset('assets/js/app.js')}}"></script>
<!-- end::custom scripts -->

<!-- begin::toastr -->
<script type="text/javascript"
        src="{{ URL::asset('js/toastr.min.js') }}"></script>
<!-- end::toastr -->

<script type="text/javascript">
    $(document).ready(function () {
        @if(Session::has('flash_message'))
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
        Command: toastr["info"]("{!! session('flash_message') !!}", "");
        @endif
            @if(Session::has('error'))
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
        Command: toastr["error"]("{!! session('error') !!}", "");
        @endif
            @if(Session::has('success'))
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
        Command: toastr["success"]("{!! session('success') !!}", "");
        @endif
    });
</script>
@include ('errors.list')

@yield('scripts')
</body>
</html>
