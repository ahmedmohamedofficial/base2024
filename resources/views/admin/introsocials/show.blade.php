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
                        <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="key" label="{{__('admin.name')}}"  disabled value="{{ $social->key }}" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="url" name="url" label="{{__('admin.link')}}"  disabled value="{{ $social->url }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="icon" label="{{__('admin.icon')}}"  disabled value="{{ $social->icon }}" />
                                    </div>


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