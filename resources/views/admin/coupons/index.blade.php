@extends('admin.layout.master')

@section('css')

@endsection

@section('content')
    <x-admin.table datefilter="true" order="true" addbutton="{{ route('admin.coupons.create') }}"
        deletebutton="{{ route('admin.coupons.deleteAll') }}" :searchArray="[
            'identity' => [
                'input_type' => 'text',
                'input_name' => __('admin.coupon_number'),
            ],
        ]">
        <x-slot name="tableContent">
            <div class="card table_content_append">

            </div>
        </x-slot>

    </x-admin.table>

    @include('admin.coupons.modal')

@endsection
<x-admin.config  sweetAlert2 datePickr select2 validation/>

@section('js')


    <script>
        $(document).on('click', '.open-coupon', function() {
            $('.coupon_id').val($(this).data('id'))
        })

        $(document).on('click', '.change-coupon-status', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.coupons.renew') }}",
                data: {
                    id: $(this).data('id'),
                    status: $(this).data('status'),
                    expire_date: $(this).data('date')
                },
                dataType: "json",
                success: (response) => {
                    $(this).parent().html(response.html)
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '.select2', function() {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            } else {
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup', '.discount', function() {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            } else {
                $('.max_discount').val(null);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '.notify-form', function(e) {
                e.preventDefault();
                var url = $(this).attr('action')
                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData($(this)[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".send-notify-button").html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                            ).attr('disable', true)
                    },
                    success: (response) => {
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')
                        $(".send-notify-button").html("{{ __('admin.update') }}").attr(
                            'disable', false)
                        $('#notify').modal('toggle');
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                        $('#div_' + response.id).parent().html(response.html)
                    },
                    error: function(xhr) {
                        $(".send-notify-button").html("{{ __('admin.update') }}").attr(
                            'disable', false)
                        $(".text-danger").remove()
                        $('.notify-form input').removeClass('border-danger')

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('.notify-form input[name=' + key + ']').addClass(
                                'border-danger')
                            $('.notify-form input[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                            $('.notify-form select[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                        });
                    },
                });

            });
        });

        flatpickr('.date', {
            disableMobile: true,
            locale: "{{ app()->getLocale() }}",
            dateFormat: "Y-m-d",
            mode:"single",
            minDate:'{{ now()->addDay()->format('Y-m-d') }}'
        });
    </script>

    {{-- delete all script --}}
    @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
    @include('admin.shared.deleteOne')
    {{-- delete one user script --}}

    {{-- delete one user script --}}
    @include('admin.shared.filter_js', ['index_route' => url('admin/coupons')])
    {{-- delete one user script --}}
@endsection
