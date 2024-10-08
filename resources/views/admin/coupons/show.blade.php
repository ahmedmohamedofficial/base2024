@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="coupon match-height">
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
                                        <x-admin.inputs.text name="coupon_num" value="{{ $coupon->coupon_num }}" label="{{__('admin.coupon_number')}}"  disabled />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" name="max_use" value="{{ $coupon->max_use }}" label="{{__('admin.number_of_use')}}"  disabled />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.select disabled name="type" label="{{__('admin.discount_type')}}"  value="{{ $coupon->type == 'ratio' ? __('admin.Percentage') : __('admin.fixed_number') }}"/>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" value="{{ $coupon->discount }}" name="discount" label="{{__('admin.discount_value')}}"  disabled />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" className="form-control max_discount" value="{{ $coupon->max_discount }}" name="max_discount" label="{{__('admin.larger_value_for_discount')}}"  required disabled/>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text value="{{ date('Y-m-d', strtotime($coupon->expire_date)) }}" type="text"  name="expire_date" label="{{__('admin.expiry_date')}}"  disabled />
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