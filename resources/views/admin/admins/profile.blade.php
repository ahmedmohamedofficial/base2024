@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')

@endsection
{{-- extra css files --}}
@section('content')

    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="bs-stepper wizard-icons wizard-icons-example mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#main_data">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <i class="fa fa-chalkboard-teacher"></i>
                          </span>
                                    <span class="bs-stepper-label">{{__('admin.main_data')}}</span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#change_password">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                           <i class="fa fa-lock"></i>
                          </span>
                                    <span class="bs-stepper-label"> {{__('admin.change_password')}}</span>
                                </button>
                            </div>

                        </div>
                        <div class="bs-stepper-content">
                            <div id="main_data" class="content">
                                <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal needs-validation store" novalidate>
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <x-admin.inputs.image  name="avatar"  inValidMessage="{{ __('admin.this_field_is_required') }}" src="{{ auth('admin')->user()->avatar }}" />
                                        </div>
                                        <div class="col-6">
                                            <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  required placeholder="{{__('admin.write_the_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ auth('admin')->user()->name }}" />
                                        </div>

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <input type="hidden" name="iso" value="" id="iso">

                                                    <x-admin.inputs.select name="country_code" id="select-country_code" label="{{ __('admin.select_country_code') }}" placeholder="{{ __('admin.select_country_code') }}" inValidMessage="{{ __('admin.this_field_is_required') }}">
                                                        <x-slot name="options">
                                                            <option value>{{ __('admin.select_city') }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country['country_code'] }}" {{ auth('admin')->user()->country_code == $country->country_code ? 'selected' : '' }} data-iso="{{ $country->iso2 }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </x-slot>
                                                    </x-admin.inputs.select>
                                                </div>
                                                <div class="col-6 col-md-8">
                                                    <x-admin.inputs.text type="number" value="{{auth('admin')->user()->phone}}" name="phone" label="{{ __('admin.phone_number') }}" required placeholder="{{ __('admin.enter_phone_number') }}" inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  required placeholder="{{__('admin.enter_the_email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ auth('admin')->user()->email }}" />
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                                            <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="change_password" class="content">
                                <form action="{{route('admin.profile.update_password')}}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.password name="old_password" required label="{{__('admin.old_password')}}"  inValidMessage="{{ __('admin.old_password') }}" />
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.password name="password" required label="{{__('admin.new_password')}}"  inValidMessage="{{ __('admin.new_password') }}" />
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.password name="password_confirmation" required label="{{__('admin.new_password_confirm')}}"  inValidMessage="{{ __('admin.new_password_confirm') }}" />
                                        </div>

                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <button type="submit" class="btn rounded-pill btn-primary m-2 submit_button">{{__('admin.saving_changes')}}</button>
                                            <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->

    </div>


@endsection
<x-admin.config sweetAlert2 validation stepper />

@section('js')

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}
    <x-admin.inputs.formAjax className="store"/>

    <script>
        $(document).ready(function() {
            $('#select-country_code').on('change', function() {
                selectCountryCode('select-country_code');
            });

            function selectCountryCode(country_id) {
                var selectedOption = $('#' + country_id).find('option:selected');
                var isoValue = selectedOption.data('iso');
                $('#iso').val(isoValue);
            }
            selectCountryCode('select-country_code');
        });

    </script>
@endsection

