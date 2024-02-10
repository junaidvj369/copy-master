<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/IR_Logo_06.png') }}" />
    <title> {{config('app.name')}} | @yield('pageTitle')</title>

    <input type="hidden" id="siteurl" value="{{url('')}}">

    @include('layouts.includes.css_header')
    @stack('css')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
   
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    @include('layouts.includes.header')

    @include('layouts.includes.sidebar')

      

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
         @yield('content')
           
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        @include('layouts.includes.footer')

        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <!-- end:: Page -->

    @include('layouts.includes.js_footer')
    @stack('js')

</body>

</html>