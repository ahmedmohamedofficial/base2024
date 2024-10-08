@extends('admin.layout.master')

@section('css')

@endsection
  
@section('content')

    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="bs-stepper wizard-icons wizard-icons-example mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#notifications">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <i class="fa fa-bell"></i>
                          </span>
                                    <span class="bs-stepper-label">{{__('admin.send_notification')}}</span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#sms">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                           <i class="fa fa-sms"></i>
                          </span>
                                    <span class="bs-stepper-label"> {{__('admin.send_sms')}}</span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#email">
                                <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <i class="fa fa-paper-plane"></i>
                          </span>
                                    <span class="bs-stepper-label">{{__('admin.send_email')}}</span>
                                </button>
                            </div>

                        </div>
                        <div class="bs-stepper-content">
                            @include('admin.notifications.tabs.notifications')
                            @include('admin.notifications.tabs.sms')
                            @include('admin.notifications.tabs.email')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->

    </div>

@endsection
<x-admin.config sweetAlert2 validation stepper select2 />


@section('js')
    <x-admin.inputs.formAjax className="notify-form"/>
@endsection