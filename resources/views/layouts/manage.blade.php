<!DOCTYPE html>
@if(Request::segment(1)=='en')

<html dir="ltr" lang="en">
@else
<html dir="rtl" lang="ar">

@endif

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/manage/assets/images/favicon.png">
    <title>@yield('title')</title>
    <!-- Custom CSS -->
    <link href="/manage/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/manage/dist/css/style.min.css" rel="stylesheet">
    @if(Request::segment(1)=='en')
    <link href="/manage/dist/css/newStyleEn.css" rel="stylesheet">
    @else
    <link href="/manage/dist/css/newStyleAr.css" rel="stylesheet">
    @endif
    <link href="/manage/toast/jquery.toast.css" rel="stylesheet" />
@yield('style')
</head>

    <body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">

    @include('include.Admin.header')
    @include('include.Admin.sidebar')
    @yield('content')

  </div>

    @include('include.Admin.settings')

    @include('include.Admin.DeleteModel')


    <script src="/manage/assets/libs/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="/manage/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/manage/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="/manage/dist/js/app.min.js"></script>
    <!-- Theme settings -->
    <script src="/manage/dist/js/app.init.js"></script>
    <script src="/manage/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/manage/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/manage/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/manage/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/manage/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/manage/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--c3 JavaScript -->
    <script src="/manage/assets/extra-libs/c3/d3.min.js"></script>
    <script src="/manage/assets/extra-libs/c3/c3.min.js"></script>
    <script src="/manage/dist/js/pages/dashboards/dashboard3.js"></script>
    <script src="/manage/toast/jquery.toast.js"></script>
   @yield('script')
   @include('include.Admin.script')

    </body>
</html>
