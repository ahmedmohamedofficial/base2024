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
                    <h4 class="card-title">{{__('admin.edit')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.clients.update' , ['id' => $row->id])}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <x-admin.inputs.image  name="avatar"  inValidMessage="{{ __('admin.this_field_is_required') }}" src="{{ $row->avatar }}" />
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  required placeholder="{{__('admin.write_the_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ $row->name }}" />
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text type="number" name="phone" label="{{__('admin.phone_number')}}"  required placeholder="{{__('admin.enter_phone_number')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ $row->phone }}" />
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  required placeholder="{{__('admin.enter_the_email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ $row->email }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.password name="password" label="{{__('admin.password')}}"   inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>


                                    <div class="col-md-12 col-12">
                                        <x-admin.inputs.select name="is_blocked" label="{{__('admin.Validity')}}"  required placeholder="{{__('admin.Select_the_blocking_status')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                            <x-slot name="options">
                                                <option {{$row->is_blocked == 1 ? 'selected' : ''}} value="1">{{__('admin.Prohibited')}}</option>
                                                <option {{$row->is_blocked == 0 ? 'selected' : ''}} value="0">{{__('admin.Unspoken')}}</option>
                                            </x-slot>
                                        </x-admin.inputs.select>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton name="{{__('admin.update')}}"/>
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

    {{-- submit edit form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit edit form script --}}
    
@endsection