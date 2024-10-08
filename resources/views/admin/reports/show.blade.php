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
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="url" label="{{__('admin.Link')}}" value="{{ $report->url }}"  disabled />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="method" label="{{__('admin.action_type')}}" value="{{ $report->method }}"  disabled />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="ip" label="{{__('admin.ip')}}" value="{{ $report->ip }}"  disabled />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="agent" label="{{__('admin.browser')}}" value="{{ $report->agent }}"  disabled />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="admin" label="{{__('admin.the_admin')}}" value="{{ optional($report->admin)->name }}"  disabled />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="email" label="{{__('admin.email')}}" value="{{ optional($report->admin)->email }}"  disabled />
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.textarea name="subject_of_report" value="{{ $report->subject}}" label="{{__('admin.subject_of_report')}}"  disabled />
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
