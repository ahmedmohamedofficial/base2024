@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="rows match-height">
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
                                    <div class="col-12">
                                        <x-admin.inputs.select className="form-control" name="intro_fqs_category_id" label="{{__('admin.section')}}" disabled value="{{ optional($fqs->category)->title }}"/>
                                    </div>

                                    @foreach (languages() as $lang)
                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="title[{{$lang}}]" label="{{__('site.question_'.$lang)}}"   value="{{ $fqs->getTranslation('title', $lang) }}" disabled />
                                    </div>
                                @endforeach
                                @foreach (languages() as $lang)
                                    <div class="col-6">
                                        <x-admin.inputs.textarea name="description[{{$lang}}]" label="{{__('site.answer_'.$lang)}}"   disabled value="{{ $fqs->getTranslation('description', $lang) }}" />
                                    </div>
                                @endforeach
                                <div class="col-12 d-flex justify-content-center mt-3">
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

@section('js')

@endsection