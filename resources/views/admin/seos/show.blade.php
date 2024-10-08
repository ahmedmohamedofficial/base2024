@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.show')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <x-admin.inputs.text name="key" label="{{__('admin.key')}}" value="{{ $seo->key }}"  disabled />
                                    </div>

                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_title[{{$lang}}]" value="{{ $seo->getTranslation('meta_title', $lang) }}" label="{{__('site.meta_title_'.$lang)}}"  disabled />
                                        </div>
                                    @endforeach
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_description[{{$lang}}]" value="{{ $seo->getTranslation('meta_description', $lang) }}" label="{{__('site.meta_description_'.$lang)}}"  disabled />
                                        </div>
                                    @endforeach
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="meta_keywords[{{$lang}}]" value="{{ $seo->getTranslation('meta_keywords', $lang) }}" label="{{__('site.meta_keywords_'.$lang)}}"  disabled />
                                        </div>
                                    @endforeach

                                    <div class="col-12 d-flex justify-content-center mt-3">
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

@section('js')

@endsection