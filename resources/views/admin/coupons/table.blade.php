<div class="table-responsive text-nowrap">

    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
            <tr>
                <th>
                    @if ($coupons->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif
                </th>
                <th>{{ __('admin.date') }}</th>
                <th>{{ __('admin.coupon_number') }}</th>
                <th>{{ __('admin.discount_type') }}</th>
                <th>{{ __('admin.discount_value') }}</th>
                <th>{{ __('admin.expiry_date') }}</th>
                <th>{{ __('admin.active_or_diactive_coupon') }}</th>
                <th>{{ __('admin.control') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
                <tr class="delete_coupon">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$coupon->id}}">
                        </div>
                    </td>
                    <td>{{\Carbon\Carbon::parse($coupon->created_at)->format('d/m/Y')}}</td>
                    <td>{{$coupon->coupon_num}}</td>
                    <td>{{$coupon->type == 'ratio' ? 'نسبة' :  'رقم ثابت'}}</td>
                    <td>{{$coupon->discount}}</td>
                    <td>{{date('d-m-Y', strtotime($coupon->expire_date))}}</td>
                    <td>
                        @if($coupon->status == 'available')
                            <span class="btn btn-sm round btn-outline-danger change-coupon-status" data-date="{{$coupon->expire_date}}" data-status="closed" data-id="{{$coupon->id}}"> 
                                {{__('admin.Stop_Coupon')}}  <i class="feather icon-slash"></i>
                            </span>
                        @else
                            <span class="btn btn-sm round btn-outline-success open-coupon" data-bs-toggle="modal" id="div_{{$coupon->id}}" data-bs-target="#notify" data-id="{{$coupon->id}}">
                                {{__('admin.reactivation_Coupon')}}  <i class="feather icon-rotate-cw"></i>
                            </span>
                        @endif
                    </td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.coupons.show' , ['id' => $coupon->id])}}"><i class="fa fa-eye"></i></a>
                        <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.coupons.edit' , ['id' => $coupon->id])}}"><i class="fa fa-edit"></i></a>
                        <span class="delete-row btn rounded-pill btn-danger m-2" data-url="{{url('admin/coupons/'.$coupon->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($coupons->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$coupons"/>

{{-- pagination  links div --}}