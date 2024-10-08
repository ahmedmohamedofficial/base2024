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
                                    <div class="col-12">
                                        <x-admin.inputs.image  name="icon" src="{{ $social->icon }}"  disabled />
                                    </div>
                                    <div class="col-6">
                                        <x-admin.inputs.text name="name" label="{{__('admin.name')}}" value="{{ $social->name }}"  disabled />
                                    </div>

                                    <div class="col-6">
                                        <x-admin.inputs.text type="url" name="link" value="{{ $social->link }}" label="{{__('admin.Link')}}"  disabled />
                                    </div>
                                    
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