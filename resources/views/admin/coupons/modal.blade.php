<div class="modal fade" id="notify" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.coupons.renew') }}" method="POST" enctype="multipart/form-data" novalidate
              class="notify-form needs-validation">
            @csrf
            <input type="hidden" name="id" class="coupon_id">
            <input type="hidden" name="status" value="available">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">{{__('admin.update_coupon_status')}}</h5>
                    <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-admin.inputs.text type="number" name="max_use" label="{{__('admin.number_of_use')}}"  required placeholder="{{__('admin.enter_number_of_use')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                        </div>

                        <div class="col-md-6 col-12">
                            <x-admin.inputs.select name="type" idName="type" label="{{__('admin.discount_type')}}"  required placeholder="{{__('admin.select_the_discount_state')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                <x-slot name="options">
                                    <option value>{{__('admin.select_the_discount_state')}}</option>
                                    <option value="ratio">{{__('admin.Percentage')}}</option>
                                    <option value="number">{{__('admin.fixed_number')}}</option>
                                </x-slot>
                            </x-admin.inputs.select>
                        </div>

                        <div class="col-md-6 col-12">
                            <x-admin.inputs.text type="number" name="discount" label="{{__('admin.discount_value')}}"  required placeholder="{{__('admin.type_the_value_of_the_discount')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
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

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn rounded-pill btn-primary send-notify-button" >{{__('admin.update')}}</button>
                    <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>