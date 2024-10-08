@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.update') . ' ' . __('admin.pages')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.pages.update' , ['id' => $pages->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('site.title_'.$lang)}}</label>
                                                <div class="controls">
                                                    <input type="text" value="{{$pages->getTranslations('title')[$lang]}}" name="title[{{$lang}}]" class="form-control" placeholder="{{__('site.write') . __('site.title_'.$lang)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach 
                                    @foreach (languages() as $lang)
                                            <div class="col-6">
                                                <x-admin.inputs.textarea name="content[{{$lang}}]"  label="{{__('admin.about_the_application_in_english')}}"  required placeholder="{{__('admin.about_the_application_in_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{!! $pages->getTranslation('content', $lang) !!}" />
                                            </div>
                                    @endforeach 
                                    
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
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
<x-admin.config sweetAlert2 validation stepper ckeditor></x-admin.config>
@section('js')
    <x-admin.inputs.formAjax className="store"/>
    <script>
        CKEDITOR.replace( 'textarea-content[ar]' );
        CKEDITOR.replace( 'textarea-content[en]' );
    </script>
    
@endsection