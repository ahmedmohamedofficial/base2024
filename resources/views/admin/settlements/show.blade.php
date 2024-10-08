@php use App\Enums\SettlementStatus; @endphp
@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('/') }}site/assets/plugins/FancyBox/jquery.fancybox.min.css">
@stop
@section('content')
    <!-- // Basic multiple Column Form section start -->


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('admin.provider_details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                            <img class="img-fluid" src="{{ $settlement->providerable?->avatar }}" alt="{{  $settlement->providerable?->name }}" width="140">
                        </div>
                        <h5 class="mb-2 pb-1">{{ __('admin.provider_name') }} : {{ $settlement->providerable?->name }}</h5>
                        <h5 class="mb-2 pb-1">{{ __('admin.provider_phone') }} : {{ $settlement->providerable?->full_phone }}</h5>
                        {{--                        Provider Details --}}
                    </div>
                </div>
            </div>
            <div class="col-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('admin.order_details') }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-2 pb-1">{{ __('admin.total_orders') }} : {{ $financialTransactions->sum('order_price') }} {{ __('apis.currency') }}</h5>
                        <h5 class="mb-2 pb-1">{{ __('admin.total_application_commission') }} : {{ $financialTransactions->sum('commission_amount') }} {{ __('apis.currency') }}</h5>
                        <h5 class="mb-2 pb-1">{{ __('admin.total_value_added') }} : {{ $financialTransactions->sum('vat_amount') }} {{ __('apis.currency') }}</h5>
                        <h5 class="mb-2 pb-1">{{ $settlement->type == 'due' ? __('admin.due_to_the_provider') : __('admin.the_provider_s_debt') }}  : {{ $settlement->amount }} {{ __('apis.currency') }}</h5>
                        <h5 class="mb-2 pb-1">{{ __('admin.orderStatus') }} : {{ $settlement->status_text }}</h5>
                    </div>
                </div>
            </div>

        @if($settlement->image)
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('admin.a_copy_of_the_bank_transfer') }}</h4>
                        </div>
                        <div class="card-body">
                            <a class="fancybox" data-fancybox="gallery" href="{{ $settlement->image_path }}">
                                <img loading="lazy" src="{{ $settlement->image_path }}" class="upload_img lg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if($settlement->rejected_reason)
                <div class="col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('admin.rejected_reason') }}</h4>
                        </div>
                        <div class="card-body">
                          <p>{{  $settlement->rejected_reason }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('admin.settlements_orders') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($settlement->financialTransactions()->latest()->get() as $financialTransaction)
                                @include('admin.settlements.items.order', ['order'=>$financialTransaction->orderable])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if($settlement->status == SettlementStatus::PENDING)
                <div class="col-12">
                    <div class="card">


                        <div class="card-content">

                            <div class="card-footer">
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="button" class="btn btn-sm btn-success accept-btn m-3" data-bs-toggle="modal"
                                            data-bs-target="#acceptModal" data-id="{{ $settlement->id }}"
                                            data-amount="{{ $settlement->amount }}" title="{{ __('admin.accept_order') }}">
                                        <i class="fa fa-check" style="color: white"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn m-3" data-bs-toggle="modal"
                                            data-bs-target="#cancelModal" data-id="{{ $settlement->id }}"
                                            title="{{ __('admin.refuse_order') }}">
                                        <i class="fa fa-times" style="color: white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card">


                    <div class="card-content">

                        <div class="card-footer">
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    @include('admin.settlements.items.accept_modal')
    @include('admin.settlements.items.cancel_modal')

@endsection

@section('js')
    <script src="{{ asset('/') }}site/assets/plugins/FancyBox/jquery.fancybox.min.js"></script>
    <script>
        $(document).on('click', '.accept-btn', function () {
            var id = $(this).data('id'),
                amount = $(this).data('amount')
            $('.settlement_id').val(id)
            $('#amount').html(amount + ' {{__('apis.currency')}}')
        });

        $(document).on('click', '.cancel-btn', function () {
            var id = $(this).data('id')
            $('.settlement_id').val(id)
        });
    </script>
    <x-admin.inputs.formAjax className="formAjax"/>
    @include('admin.shared.addImage')

@endsection