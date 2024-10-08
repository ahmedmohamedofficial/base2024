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
                        <form  method="POST" action="{{route('admin.seos.update' , ['id' => $seo->id])}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <x-admin.inputs.text name="key" label="{{__('admin.key')}}" value="{{ $seo->key }}"  required placeholder="{{__('admin.write_key')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_title[{{$lang}}]" value="{{ $seo->getTranslation('meta_title', $lang) }}" label="{{__('site.meta_title_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.meta_title_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_description[{{$lang}}]" value="{{ $seo->getTranslation('meta_description', $lang) }}" label="{{__('site.meta_description_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.meta_description_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_keywords[{{$lang}}]" value="{{ $seo->getTranslation('meta_keywords', $lang) }}" label="{{__('site.meta_keywords_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.meta_keywords_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton name="{{__('admin.update')}}"/>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-warning m-2">{{__('admin.back')}}</a>
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

   
    {{-- submit edit form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit edit form script --}}
    
@endsection