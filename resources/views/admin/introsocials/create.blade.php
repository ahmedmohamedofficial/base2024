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
                    <h4 class="card-title">{{__('admin.add')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.introsocials.store')}}" class="store needs-validation form-horizontal" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                   
                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="key" label="{{__('admin.name')}}"  required placeholder="{{__('admin.write_the_name') }}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="url" name="url" label="{{__('admin.link')}}"  required placeholder="{{__('admin.enter_the_link') }}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="icon" label="{{__('admin.icon')}}"  required placeholder="{{__('admin.enter_the_icon') }}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
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
<x-admin.config sweetAlert2 validation/>

@section('js')

    {{-- submit add form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit add form script --}}
    
@endsection