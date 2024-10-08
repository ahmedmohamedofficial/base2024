@extends('admin.layout.master')
@section('content')
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

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="name" label="{{__('admin.user_name')}}"   value="{{ $message->name }}" disabled />
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="phone" label="{{__('admin.phone')}}"   value="{{ $message->phone }}" disabled />
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="email" label="{{__('admin.email')}}"   value="{{ $message->email }}" disabled />
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.textarea name="message" label="{{__('admin.text_of_message')}}"  value="{{ $message->message }}" disabled />
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
