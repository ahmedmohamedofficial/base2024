@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')

@endsection
{{-- extra css files --}}

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.copy')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  method="POST" action="{{route('admin.copys.store')}}" class="store form-horizontal needs-validation" novalidate>
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <x-admin.inputs.image  name="image"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>

                                        <div class="col-6">
                                            <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  required placeholder="{{__('admin.write_the_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>

                                        <div class="col-6">
                                            <x-admin.inputs.text type="number" name="phone" label="{{__('admin.phone_number')}}"  required placeholder="{{__('admin.enter_phone_number')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>

                                        <div class="col-6">
                                            <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  required placeholder="{{__('admin.enter_the_email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.password name="password" label="{{__('admin.password')}}"  required  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="intro_about" label="{{__('admin.about_app')}}"  required placeholder="{{__('admin.about_app')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.select name="block" label="{{__('admin.ban_status')}}"  required placeholder="{{__('admin.Select_the_blocking_status')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                                <x-slot name="options">
                                                    <option value>{{ __('admin.Select_the_blocking_status') }}</option>
                                                    <option value="1">{{ __('admin.Prohibited') }}</option>
                                                    <option value="0">{{ __('admin.Unspoken') }}</option>
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
@endsection
