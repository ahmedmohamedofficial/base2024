<div id="smtp" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate>
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="smtp">
        <div class="row g-3">

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="smtp_user_name" label="{{__('admin.user_name')}}"  required placeholder="{{__('admin.user_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_user_name') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.password name="smtp_password" label="{{__('admin.password')}}"  required  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_password') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="email" name="smtp_mail_from" label="{{__('admin.email_Sender')}}"  required placeholder="{{__('admin.user_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_mail_from') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="smtp_sender_name" label="{{__('admin.the_sender_name')}}"  required placeholder="{{__('admin.the_sender_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_sender_name') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="smtp_host" label="{{__('admin.the_nouns_al')}}"  required placeholder="{{__('admin.the_sender_name')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_host') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="smtp_encryption" label="{{__('admin.encryption_type')}}"  required placeholder="{{__('admin.encryption_type')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_encryption') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="number" name="smtp_port" label="{{__('admin.Port_number')}}"  required placeholder="{{__('admin.Port_number')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('smtp_port') }}" />
            </div>


            <div class="col-12 d-flex justify-content-center mt-3">
                <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
            </div>
        </div>
    </form>
</div>
