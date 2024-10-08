@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/css/pages/page-profile.css">

@endsection

@section('content')
    <div class="app-content content m-0">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper m-0 p-0">
            <div class="content-body">
                <div id="user-profile">
                    @include('admin.clients.parts.links')

                    <section id="profile-info">
                        <div class="row">

                            <div class="col-lg-8 col-12 refrshed-data ">
                                @include('admin.clients.parts.main_data')
                                
                            </div>
                            
                            <div class="col-lg-4 col-12">
                                @include('admin.clients.parts.charge_wallet')
                                @include('admin.clients.parts.notify')
                            </div>

                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
@endsection

<x-admin.config sweetAlert2 validation/>

@section('js')


    <x-admin.inputs.formAjax className="notify-form"/>

    <script>

        $(document).on('click' , '.delete-row', function (e) {
            e.preventDefault()
            Swal.fire({
                title: "{{__('admin.do_you_want_to_continue')}}",
                text: "{{__('admin.you_will_not_be_able_to_revert_this_action')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{__('admin.confirm')}}',
                cancelButtonText: '{{__('admin.cancel')}}',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-primary'
                },
                }).then( (result) => {
                if (result.value) {
                    $.ajax({
                        type: "delete",
                        url: $(this).data('url'),
                        data: {
                            deletails:true
                        },
                        dataType: "json",
                        success:  (response) => {
                            toastr.success('{{__('admin.deleted_successfully')}}');
                            setTimeout(function () {
                                window.location = '{{route('admin.clients.index')}}';
                            }, 3000);
    
    
                        }
                    });
                }
            })
        });

        $(document).on('click' , '.show-details-links li a', function (e) {
            e.preventDefault()
            var url = $(this).data('href')
            $.ajax({
                url: url,
                method: 'get',
                data: {},
                dataType: 'json',
                beforeSend: function() {
                    $('.show-details-links').css('cursor', 'progress');
                    // $(".refrshed-data").html().attr('disable', true)
                },
                success: function(response) {
                    // $(".submit_button").html("{{ __('admin.add') }}").attr('disable', false)
                    $('.show-details-links').css('cursor', 'pointer');
                    $(".refrshed-data").html(response.html)
                },
            });
        });

        $(document).on('submit', '.updateBalance', function(e) {
            e.preventDefault();
            var url = $(this).attr('action')
            var button = $(".updateBalance .submit-button") ;
            var buttonContent = button.html()
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disabled', true)
                },
                success: (response) => {
                    button.html(buttonContent).attr('disabled', false)
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        title: response.msg ,
                        showConfirmButton: false,
                        timer: 1500,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                    $('.available_balance').html(response.balance)
                },
                
            });

        });
    </script>
@endsection
