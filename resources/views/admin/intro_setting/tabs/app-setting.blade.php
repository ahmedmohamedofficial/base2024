<div id="app-setting" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate >
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="intro_app_setting">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <x-admin.inputs.text name="intro_name_ar" label="{{__('admin.name_of_induction_in_arabic')}}"  required placeholder="{{__('admin.name_of_induction_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_name_ar') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text name="intro_name_en" label="{{__('admin.name_of_the_induction_of_english')}}"  required placeholder="{{__('admin.name_of_the_induction_of_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_name_en') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text name="intro_email" type="email" label="{{__('admin.email')}}"  required placeholder="{{__('admin.email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_email') }}" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="intro_phone" label="{{__('admin.phone')}}"  required placeholder="{{__('admin.phone')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_phone') }}"  :parameters="['minlength'=>10]" />
            </div>
            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="intro_address" label="{{__('admin.address')}}"  required placeholder="{{__('admin.address')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_address') }}" />
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="account-name">{{__('admin.The_main_website_color')}}</label>
                            <input type="color" class="form-control" name="color" id="account-name" placeholder="{{__('admin.The_main_website_color')}}" value="{{settings('color')}}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="account-name">{{__('admin.the_color_of_the_buttons')}}</label>
                            <input type="color" class="form-control" name="buttons_color" id="account-name" placeholder="{{__('admin.the_color_of_the_buttons')}}" value="{{settings('buttons_color')}}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="account-name">{{__('admin.color_of_hover')}}</label>
                            <input type="color" class="form-control" name="hover_color" id="account-name" placeholder="{{__('admin.color_of_hover')}}" value="{{settings('hover_color')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="intro_logo"  src="{{ settings('intro_logo')}}" desc="{{__('admin.logo_image_induction')}}" />
                    </div>
                    <div class="col-lg-4">
                        <x-admin.inputs.image  name="intro_loader"  src="{{ settings('intro_loader')}}" desc="{{__('admin.Picture_of_Loader')}}" />
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