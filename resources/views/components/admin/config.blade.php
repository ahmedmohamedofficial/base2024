@section('config-css')

    @if ($sweetAlert2)
        <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css">
    @endif

    @if ($datePickr)
        <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/flatpickr/flatpickr.css">
    @endif



    @if ($validation)
        <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/styles/index.min.css">
    @endif

    @if($select2)
        <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/select2/select2.css">
    @endif

    @if($stepper)
        <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/bs-stepper/bs-stepper.css" />
    @endif
    @if($ckeditor)
        <style>
            .cke_notifications_area{
                display: none;
            }
        </style>
    @endif


@stop

@section('config-js')

    @if ($sweetAlert2)
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    @endif

    @if ($datePickr)
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/flatpickr/flatpickr.js"></script>
        @if(lang() == 'ar')
            <script src="{{ asset('/') }}dashboard/assets/vendor/libs/flatpickr/flatpickrAr.js"></script>
        @endif
    @endif



    @if ($validation)
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
        <script src="{{ asset('/') }}dashboard/assets/js/form-validation.js"></script>
    @endif

    @if($select2)
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/select2/select2.js"></script>
        <script>
            $('.select2').select2({
                "language": {
                    "noResults": function(){
                        return "{{ __('admin.noResults') }}";
                    }
                }});
            $('.modal .select2').select2({
                dropdownParent: $('.modal'),
                "language": {
                    "noResults": function(){
                        return "{{ __('admin.noResults') }}";
                    }
                }});


            $('.offcanvas .select2').select2({
                dropdownParent: $('.offcanvas-body'),
                "language": {
                    "noResults": function(){
                        return "{{ __('admin.noResults') }}";
                    }
                }});
        </script>
    @endif

    @if($stepper)
        <script src="{{ asset('/') }}dashboard/assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
        <script src="{{ asset('/') }}dashboard/assets/js/form-wizard-icons.js"></script>
    @endif

    @if($ckeditor)
        <script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>

    @endif

    @if($scrollbar)
        <script>
            $('.contentHolder').each((index, element) => {
                new PerfectScrollbar(element);
            });
        </script>
    @endif

@stop