<div class="col-6 mb-3">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <span>{{ __('admin.order_number') }} :</span> <span>{{ $order->order_num }}</span>
            </h5>
        </div>

        <div class="card-content">
            <div class="card-body">

                <div class="row mb-1">
                    <div class="col-4">{{ __('admin.order_date') }} :</div>
                    <div class="col-8">{{ $order->created_at->format('Y-m-d') }} </div>
                </div>

                <div class="row mb-1">
                    <div class="col-4">{{ __('admin.price_of_products') }} :</div>
                    <div class="col-8"> {{ $order->total_products }} {{ __('apis.currency') }}</div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">{{ __('admin.value_added_tax') }} :</div>
                    <div class="col-8"> {{ $order->vat_amount }} {{ __('apis.currency') }}</div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">{{ __('admin.opposition') }} :</div>
                    <div class="col-8"> {{ $order->coupon_value??0 }} {{ __('apis.currency') }}</div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">{{ __('admin.total_price') }} :</div>
                    <div class="col-8"> {{ $order->final_total  }} {{ __('apis.currency') }}</div>
                </div>

            </div>
        </div>
    </div>
</div>