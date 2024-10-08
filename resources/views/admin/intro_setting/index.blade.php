@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')

@endsection
{{-- extra css files --}}
@section('content')
    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="bs-stepper wizard-icons wizard-icons-example mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#app-setting">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <i class="fa fa-gear"></i>
                          </span>
                                    <span class="bs-stepper-label">{{__('admin.app_setting')}}</span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#about_app">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                           <i class="fa fa-edit"></i>
                          </span>
                                    <span class="bs-stepper-label"> {{__('admin.about_app')}}</span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#texts">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <i class="fa fa-text-width"></i>
                          </span>
                                    <span class="bs-stepper-label">{{__('admin.Frequent_texts')}}</span>
                                </button>
                            </div>

                        </div>
                        <div class="bs-stepper-content">
                            @include('admin.intro_setting.tabs.app-setting')
                            @include('admin.intro_setting.tabs.about_app')
                            @include('admin.intro_setting.tabs.texts')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->

    </div>

@endsection
<x-admin.config sweetAlert2 validation stepper ckeditor />

@section('js')
    <x-admin.inputs.formAjax className="form-ajax"/>

    @include('admin.shared.addImage')
    {{-- show selected image script --}}
@endsection
