@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')

@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.add')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.coupons.store')}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text name="coupon_num" label="{{__('admin.coupon_number')}}"  required placeholder="{{__('admin.enter_coupon_number')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" name="max_use" label="{{__('admin.number_of_use')}}"  required placeholder="{{__('admin.enter_number_of_use')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.select name="type" label="{{__('admin.discount_type')}}"  required placeholder="{{__('admin.select_the_discount_state')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                            <x-slot name="options">
                                                <option value>{{__('admin.select_the_discount_state')}}</option>
                                                <option value="ratio">{{__('admin.Percentage')}}</option>
                                                <option value="number">{{__('admin.fixed_number')}}</option>
                                            </x-slot>
                                        </x-admin.inputs.select>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" className="form-control discount" name="discount" label="{{__('admin.discount_value')}}"  required placeholder="{{__('admin.type_the_value_of_the_discount')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="number" className="form-control max_discount" name="max_discount" label="{{__('admin.larger_value_for_discount')}}"  required placeholder="{{__('admin.write_the_greatest_value_for_the_discount')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" :parameters="['readonly'=>true]" />
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <x-admin.inputs.text type="text" className="form-control date" name="expire_date" label="{{__('admin.expiry_date')}}"  required placeholder="{{__('admin.expiry_date')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" :parameters="['readonly'=>true]" />
                                    </div>


                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton name="{{__('admin.add')}}"/>
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
<x-admin.config sweetAlert2 validation select2 datePickr/>

@section('js')


    <script>
        $(document).on('change','.select2', function () {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            }else{
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup','.discount', function () {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            }else{
                if ($(this).val() > 100) {
                    $(this).val(null)
                    toastr.error('{{__('admin.Percentage_must_not_bigger_than_100')}}')
                }
                $('.max_discount').val(null);
            }
        });

        flatpickr('.date', {
            disableMobile: true,
            locale: "{{ app()->getLocale() }}",
            dateFormat: "Y-m-d",
            mode:"single",
            minDate:'{{ now()->addDay()->format('Y-m-d') }}'
        });
        
    </script>
    


    {{-- submit add form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit add form script --}}
    
@endsection