<!DOCTYPE html>

<html
        lang="{{ lang() }}"
        class="light-style layout-navbar-fixed layout-menu-fixed loaded"
        dir="{{ lang() == 'ar' ? 'rtl' : 'ltr' }}"
        data-theme="theme-default"
        data-assets-path="{{ asset('/') }}dashboard/assets/"
        data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" href="{{Cache::get('settings')['fav_icon']}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{Cache::get('settings')['fav_icon']}}">

    <title>
        @yield('title' ,__('routes.'.\Route::currentRouteName()) ?? '')
    </title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
            rel="stylesheet" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/toastr/toastr.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/') }}dashboard/assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/spinkit/spinkit.css">
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/animate-css/animate.css">

    @yield('css')
    @yield('config-css')

</head>


<body>
<audio class="d-none" controls="" id="soundNotify"> <source src="{{ asset('/') }}sound/in.mp3" type="audio/ogg"> </audio>

<div id="toast-container" class="toast toast-ex  show mt-4" style="box-shadow: none; background: transparent">

</div>




{{-- loader --}}
        <div class="loader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
    {{-- loader --}}

