@include('admin.layout.partial.header')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            @include('admin.layout.partial.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('admin.layout.partial.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('breadcrumb')
                    <h4 class="py-3 mb-4">
                        <a  href="{{url('admin/dashboard')}}">
                            <span class="text-muted fw-light"> <i class="fa fa-home"></i> {{__('site.home')}}</span></a>
                        @if (Route::currentRouteName() != 'admin.dashboard')
                            / {{__('routes.'.\Request::route()->getAction()['as'])}}
                        @endif
                    </h4>
                    @yield('content')
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                            <div>
                                {{__('admin.Copyrights')}} &copy; {{\Carbon\Carbon::now()->year}}
                                ,  {{__('admin.all_rights_reserved')}} ❤️  {{ __('admin.by') }}
                                <a href="#" target="_blank" class="fw-medium">{{__('admin.base2024')}}</a>

                            </div>
                            <div class="d-none d-lg-inline-block">
                                <div class="demo-inline-spacing">
                                    <a class="btn btn-icon btn-outline-primary waves-effect" target="_blank" href="mailto:salesbuisnessofficial@gmail.com" ><i class="fa fa-envelope pink"></i></a>
                                    {{-- <a class="btn btn-icon btn-outline-primary waves-effect" target="_blank" href="tel:920005929" ><i class="fa fa-phone pink"></i></a> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </footer>




                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
</div>
@include('admin.layout.partial.footer')
<!-- / Footer -->
<x-admin.alert />

</body>
</html>