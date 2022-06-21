<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
    <title>محفظة الكترونية</title>
    @else
    <title>E-Wallet</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('styleChart')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin/images/logo.png")}}">
    <!-- Bootstrap Css -->
    <link href="{{asset("assets/admin/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset("assets/admin/css/icons.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    @yield("style")
    @if(LaravelLocalization::getCurrentLocale() == 'ar')

    <link href="{{asset("assets/admin/css/app-rtl.css")}}" rel="stylesheet" type="text/css"/>
    @else
    <link href="{{asset("assets/admin/css/app.css")}}" rel="stylesheet" type="text/css"/>

    @endif

</head>

<body data-sidebar="dark">

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="#" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset("assets/admin/images/1.png")}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset("assets/admin/images/1.png")}}" alt="" height="36">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="d-none d-sm-block ml-2">
                    <h4 class="page-title">@yield('pageTitle')</h4>
                </div>
            </div>

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input form-control" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex">

                <div class="dropdown d-none d-lg-inline-block mr-2">
                    <button type="button" class="btn header-item toggle-search noti-icon waves-effect" data-target="#search-wrap">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </div>

                <div class="dropdown d-none d-lg-inline-block mr-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>
                @if(LaravelLocalization::getCurrentLocale() == 'ar')
                <div class="dropdown d-none d-md-block mr-2">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="font-size-16"> العربية </span> <img class="ml-2" src="{{asset('assets/admin/images/ar_flag.png')}}" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item notify-item">
                            <img src="{{asset('assets/admin/images/us_flag.jpg')}}" alt="user-image" height="12"> <span class="align-middle"> English </span>
                        </a>

                    </div>
                </div>
                @else
                <div class="dropdown d-none d-md-block mr-2">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="font-size-16"> English </span> <img class="ml-2" src="{{asset('assets/admin/images/us_flag.jpg')}}" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="dropdown-item notify-item">
                            <img src="{{asset('assets/admin/images/ar_flag.png')}}" alt="user-image" height="12"> <span class="align-middle"> العربية </span>
                        </a>

                    </div>
                </div>
                @endif

                <div class="dropdown d-none d-md-block mr-2">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="font-size-16"> {{Session::get('currency')}}  </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{route('currency.change.dropdown',['currency'=>'USD'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> USD </span>
                        </a>

                        <a href="{{route('currency.change.dropdown',['currency'=>'KWD'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> KWD </span>
                        </a>

                        <a href="{{route('currency.change.dropdown',['currency'=>'SAR'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> SAR </span>
                        </a>

                        <a href="{{route('currency.change.dropdown',['currency'=>'AED'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> AED </span>
                        </a>

                        <a href="{{route('currency.change.dropdown',['currency'=>'OMR'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> OMR </span>
                        </a>

                        <a href="{{route('currency.change.dropdown',['currency'=>'EGP'])}}" class="dropdown-item notify-item">
                            <span class="align-middle"> EGP </span>
                        </a>



                    </div>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{asset('assets/admin/images/logo.png')}}" alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('vendor.updateProfile')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> {{__('layout.profile')}}</a>
                        <a class="dropdown-item" href="{{route('vendor.myWishlist')}}"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> {{__('layout.my_Wishlist')}}</a>
                        <a class="dropdown-item d-block" href="{{route('vendor.transaction',['vendor_id'=>Auth::guard('vendor')->user()->id,'admin'=>0])}}"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> {{__('layout.transactions')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#">
                            {{-- <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> --}}
                            <form action="{{route('logout')}}" method="post">
                                @csrf

                                <input type="submit" value="{{__('layout.logout')}}" class="dropdown-item text-danger">
                            </form>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">
            {{-- @if(LaravelLocalization::getCurrentLocale() == 'ar')
                @include('vendor.sections.sections_ar')
            @else --}}
                @include('vendor.sections')
            {{-- @endif --}}

        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    @if($errors->any())
        <center><div class="col-sm-12 btn btn-success">{{ implode('', $errors->all()) }}</div></center>
    @endif

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield("content")

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">

                    </div>
                </div>
            </footer>
        </div>

    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->

<script src="{{asset("assets/admin/libs/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/metismenu/metisMenu.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/node-waves/waves.min.js")}}"></script>
@yield("script")
{{-- <script src="{{asset("assets/admin/js/app.js")}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset("assets/admin/js/script.js")}}"></script> --}}
</body>
</html>
