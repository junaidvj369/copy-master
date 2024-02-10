<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf" content="{{ csrf_token() }}">
    <title> {{config('app.name')}} | @yield('pageTitle')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('user.layouts.includes.css_header')
    @stack('css')
</head>
<body>
@include('user.layouts.includes.header')

@yield('content')

@include('user.layouts.includes.footer')

@include('user.layouts.includes.js_footer')
@stack('js')

</body>

</html>