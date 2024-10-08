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
                        <form  method="POST" action="{{route('admin.intros.store')}}" class="store form-horizontal formAjax needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <x-admin.inputs.image  name="image" inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    @foreach (languages() as $lang)
                                        <div class="col-6">
                                            <x-admin.inputs.textarea name="title[{{$lang}}]" label="{{__('site.title_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.title_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach
                                    
                                    @foreach (languages() as $lang)
                                        <div class="col-6">
                                            <x-admin.inputs.textarea name="description[{{$lang}}]" label="{{__('site.description_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.description_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach


                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton/>
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
    <x-admin.inputs.formAjax/>

    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
{{--        @include('admin.shared.submitAddForm')--}}
    {{-- submit add form script --}}
    
@endsection