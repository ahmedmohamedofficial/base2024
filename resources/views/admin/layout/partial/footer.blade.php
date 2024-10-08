
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/js/menu.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/js/main.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/toastr/toastr.js"></script>
    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/block-ui/block-ui.js"></script>


    {{-- <x-socket /> --}}

    <x-admin.firebase authType="admin"/>

    @yield('config-js')
    @yield('js')


