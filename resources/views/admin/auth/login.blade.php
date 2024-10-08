<!DOCTYPE html>

<html
        lang="en"
        class="light-style customizer-hide"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="{{ asset('/') }}dashboard/assets/"
        data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{__('site.login')}}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('storage/images/settings/fav_icon.png')}}" />

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
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/') }}dashboard/assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/toastr/toastr.css">

</head>

<body>
<!-- Content -->
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
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img
                        src="{{ asset('/') }}dashboard/assets/img/illustrations/auth-login-illustration-light.png"
                        alt="auth-login-cover"
                        class="img-fluid my-5 auth-illustration h-100"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.png" />


            </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ settings('logo') }}" alt="">
                </span>
                    </a>
                </div>
                <!-- /Logo -->
                <h3 class="mb-1 fw-bold">{{__('site.title_login', ['site_name'=> settings('name', true) ])}}! </h3>
                <p class="mb-4">{{ __('site.desc_login') }}</p>

                <form id="formAuthentication" class="mb-3 formAjax needs-validation" method="POST" action="{{route('admin.login')}}" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('site.email')}}</label>
                        <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="{{__('site.email')}}"
                                autofocus />
                        <div class="error error_email"></div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{__('site.password')}}</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="{{__('site.password')}}"
                                    aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        <div class="error error_password"></div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" />
                            <label class="form-check-label" for="remember-me">{{__('site.remember')}}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100 submit-button">{{__('site.login')}}</button>
                    <div class="btn btn-primary d-grid w-100 d-none uploadProgress"><i class="fas fa-spinner"></i></div>
                </form>
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>

<!-- / Content -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('/') }}dashboard/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/hammer/hammer.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/i18n/i18n.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

<!-- Main JS -->
<script src="{{ asset('/') }}dashboard/assets/js/main.js"></script>
<script src="{{ asset('/') }}dashboard/assets/vendor/libs/toastr/toastr.js"></script>

<x-admin.inputs.formAjax className="formAjax"/>
<!-- Page JS -->
</body>
</html>
