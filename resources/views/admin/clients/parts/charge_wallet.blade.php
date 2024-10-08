<div class="card card-border-shadow-danger mb-3">
    <div class="card-header d-flex justify-content-between">
        <h4>{{ __('admin.add_or_deduct_balance') }}</h4>
    </div>
    <div class="card-body">

        <form class="updateBalance needs-validation" action="{{ route('admin.clients.updateBalance' , ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">

                <div class="col-8">
                    <x-admin.inputs.text idName="balance" type="number" :parameters="['step'=>'0.1']" name="balance"   required placeholder="{{__('admin.amount')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}"  />
                </div>

                <div class="col-4">
                    <select name="type" id="" class="form-control">
                        <option value="0">{{ __('admin.charge') }}</option>
                        <option value="1">{{ __('admin.debt') }}</option>
                    </select>
                </div>

            </div>

            <div class="d-flex align-items-center">
                <button type="submit"
                        class="submit-button btn  btn-labeled btn-labeled-right ml-auto legitRipple btn-primary mt-3"> <i class="feather icon-navigation"></i>{{  __('admin.send') }}</button>
            </div>
        </form>
    </div>
</div>