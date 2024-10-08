
<div class="card store card-border-shadow-info">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  disabled value="{{ $row->name }}" />
            </div>

            <div class="col-6">
                <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  disabled value="{{ $row->name }}" />
            </div>

            <div class="col-6">
                <x-admin.inputs.text type="number" name="phone" label="{{__('admin.phone_number')}}"  disabled value="{{ $row->phone }}" />
            </div>

            <div class="col-6">
                <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  disabled value="{{ $row->email }}" />
            </div>


            <div class="col-md-6 col-12">
                <x-admin.inputs.select className="form-control" name="is_blocked" label="{{__('admin.Validity')}}" value="{{ $row->is_blocked == 1 ?__('admin.Prohibited') : __('admin.Unspoken') }}"  disabled />
            </div>

        </div>
    </div>
</div>