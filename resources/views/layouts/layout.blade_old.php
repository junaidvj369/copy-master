<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/IR_Logo_06.png') }}" />
    <title> {{config('app.name')}} | @yield('pageTitle')</title>

    <input type="hidden" id="siteurl" value="{{url('')}}">

    @include('backend.layouts.includes.css_header')
    @stack('css')
</head>
<!-- end::Head -->
<style>


</style>

<body class="text-left">

    <!-- Loader starts-->
    <div class="loader-wrapper js-loader-container">
        <div class="loader bg-white">
            <div class="whirly-loader"> </div>
        </div>
    </div>
    <!-- Loader ends-->

    <div class="app-admin-wrap layout-sidebar-large clearfix">

        @include('backend.layouts.includes.header')

        @include('backend.layouts.includes.sidebar')
        <!-- END: Left Aside -->
        @yield('content')

    </div>

    <!-- end:: Body -->
    <!-- begin::Footer -->
    @include('backend.layouts.includes.footer')
    <!-- end::Footer -->
    <!-- end:: Page -->

    @include('backend.layouts.includes.js_footer')
    @stack('js')
</body>
<!-- end::Body -->

</html>
