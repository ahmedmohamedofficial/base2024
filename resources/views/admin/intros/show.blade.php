@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.view')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                        <x-admin.inputs.image  name="image" src="{{ $intro->image }}" disabled />
                                    </div>

                                    @foreach (languages() as $lang)
                                        <div class="col-6">
                                            <x-admin.inputs.textarea name="title[{{$lang}}]" value="{{ $intro->getTranslation('title', $lang) }}" label="{{__('site.title_'.$lang)}}"  disabled />
                                        </div>
                                    @endforeach

                                    @foreach (languages() as $lang)
                                        <div class="col-6">
                                            <x-admin.inputs.textarea name="description[{{$lang}}]" value="{{ $intro->getTranslation('description', $lang) }}" label="{{__('site.description_'.$lang)}}"  disabled />
                                        </div>
                                    @endforeach


                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

@endsection