@extends('admin.layout.master')
@section('css')

@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="complaint match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('admin.the_resolution_of_complaining_or_proposal') }}</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="user_name" value="{{ $complaint->user_name }}" label="{{__('admin.user_name')}}"  disabled />
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="phone" value="{{ $complaint->phone }}" label="{{__('admin.phone')}}"  disabled />
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="email" value="{{ $complaint->email }}" label="{{__('admin.email')}}"  disabled />
                                        </div>
                                        <div class="col-6">
                                            <x-admin.inputs.textarea name="complaint" value="{{ $complaint->complaint }}" label="{{__('admin.complaining')}}"  disabled />
                                        </div>



                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                            <a data-bs-toggle="modal" data-bs-target="#replay"
                                                class="btn rounded-pill btn-outline-primary m-2">{{ __('admin.replay') }}</a>
                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="replay" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.complaint.replay', ['id' => $complaint->id]) }}" method="POST"
                      enctype="multipart/form-data" class="notify-form needs-validation">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">{{__('admin.the_replay')}}</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <x-admin.inputs.textarea name="replay" label="{{__('admin.the_replay')}}"  required placeholder="{{__('admin.the_replay')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn rounded-pill btn-primary send-notify-button" >{{__('admin.send')}}</button>
                            <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection
<x-admin.config sweetAlert2 validation/>

@section('js')

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
                    success: function(response) {
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')
                        $(".send-notify-button").html("{{ __('admin.send') }}").attr('disable',
                            false)
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: '{{ __('admin.replay_successfullay')  }}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                        setTimeout(function() {
                            window.location.replace(response.url)
                        }, 1000);
                    },
                    error: function(xhr) {
                        $(".send-notify-button").html("{{ __('admin.send') }}").attr('disable',
                            false)
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('.store input[name=' + key + ']').addClass(
                                'border-danger')
                            $('.store input[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                            $('.store select[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                        });
                    },
                });

            });
        });
    </script>
@endsection
