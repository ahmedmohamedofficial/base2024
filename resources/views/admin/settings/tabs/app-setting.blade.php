<div id="app-setting" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate>
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="app_setting">
        <div class="row">
            <div class="col-12 col-md-6">
                <x-admin.inputs.text name="name_ar" label="{{__('admin.the_name_of_the_application_in_arabic')}}" value="{{ settings('name_ar') }}"  required placeholder="{{__('admin.the_name_of_the_application_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text name="name_en" label="{{__('admin.the_name_of_the_application_in_english')}}" value="{{ settings('name_en') }}"  required placeholder="{{__('admin.the_name_of_the_application_in_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}" value="{{ settings('email') }}"  required placeholder="{{__('admin.email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text  name="phone" label="{{__('admin.phone')}}" value="{{ settings('phone') }}"  required placeholder="{{__('admin.phone')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text  name="whatsapp" label="{{__('admin.whatts_app_number')}}" value="{{ settings('whatsapp') }}"  required placeholder="{{__('admin.whatts_app_number')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text  name="max_distance" label="{{__('admin.max_distance')}}" value="{{ settings('max_distance') }}"  required placeholder="{{__('admin.max_distance')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text  name="vat" label="{{__('admin.vat_value')}}" value="{{ settings('vat') }}"  required placeholder="{{__('admin.vat_value')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text  name="administration_fee_percentage" label="{{__('admin.administration_fee_percentage')}}" value="{{ settings('administration_fee_percentage') }}"  required placeholder="{{__('admin.administration_fee_percentage')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-12 col-md-6">
                <label class="switch switch-success">
                    <input type="checkbox" class="switch-input" name="is_production" {{ settings('is_production')  == '1' ? 'checked' : ''}}>
                    <span class="switch-toggle-slider">
                                              <span class="switch-on">
                                                <i class="ti ti-check"></i>
                                              </span><span class="switch-off"><i class="ti ti-x"></i></span></span>
                    <span class="switch-label">is production</span>
                </label>
            </div>


            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="logo"  src="{{  settings('logo') }}" desc="{{__('admin.logo_image')}}" />
                    </div>
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="fav_icon"  src="{{ settings('fav_icon') }}" desc="{{__('admin.fav_icon_image')}}" />
                    </div>
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="login_background"  src="{{ settings('login_background')}}" desc="{{__('admin.background_image')}}" />
                    </div>
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="default_user"  src="{{ settings('default_user')}}" desc="{{__('admin.virtual_user_image')}}" />
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center mt-3">
                <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
            </div>
        </div>
    </form>
</div>
