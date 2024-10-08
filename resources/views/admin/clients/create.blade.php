@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('/')}}admin/map.css">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.add')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.clients.store')}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <x-admin.inputs.image  name="avatar"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  required placeholder="{{__('admin.write_the_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <x-admin.inputs.select name="country_code" id="select-country_code" label="{{ __('admin.select_country_code') }}" placeholder="{{ __('admin.select_country_code') }}" inValidMessage="{{ __('admin.this_field_is_required') }}">
                                                    <x-slot name="options">
                                                        <option value>{{ __('admin.select_city') }}</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country['country_code'] }}" {{ $loop->first ? 'selected' : '' }} data-iso="{{ $country->iso2 }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </x-slot>
                                                </x-admin.inputs.select>
                                            </div>

                                            <div class="col-6 col-md-8">
                                                <x-admin.inputs.text type="number" name="phone" label="{{ __('admin.phone_number') }}" required placeholder="{{ __('admin.enter_phone_number') }}" inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  required placeholder="{{__('admin.enter_the_email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.password name="password" label="{{__('admin.password')}}"  required  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="" class="label">{{ __('admin.location_on_map') }}</label>
                                            <div class="with_icon main-input">
                                                <input type="text" id="address" name="map_desc" value="{{old('map_desc')}}" class="map-input form-control" data-bs-toggle="modal" data-bs-target="#staticBackdrop_4" placeholder="{{ __('admin.enter_location') }}" readonly>
                                                <img loading="lazy" src="{{ asset('/')}}admin/img/pin.png" alt="pin-img" class="icon">
                                            </div>
                                        </div>
                                    </div>
                                    @include('admin.shared.modals.map')

                                    <div class="col-md-12 col-12">
                                        <x-admin.inputs.select name="is_blocked" label="{{__('admin.Validity')}}"  required placeholder="{{__('admin.Select_the_blocking_status')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                            <x-slot name="options">
                                                <option value>{{__('admin.Select_the_blocking_status')}}</option>
                                                <option value="1">{{__('admin.Prohibited')}}</option>
                                                <option value="0">{{__('admin.Unspoken')}}</option>
                                            </x-slot>
                                        </x-admin.inputs.select>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton name="{{__('admin.add')}}"/>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<x-admin.config sweetAlert2 validation select2/>

@section('js')

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit add form script --}}
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
    <x-admin.map currentLocation="true" />

@endsection