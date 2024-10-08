<div id="notifications" class="content">
    <form action="{{route('admin.notifications.send')}}" method="POST" enctype="multipart/form-data" class="notify-form needs-validation" novalidate>
        @csrf
        <input type="hidden" name="type" value="notify">
        <div class="row g-3">
            <div class="col-md-6 col-12">
                <x-admin.inputs.textarea name="body_ar" label="{{__('admin.the_message_in_arabic')}}"  required placeholder="{{__('admin.the_message_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-md-6 col-12">
                <x-admin.inputs.textarea name="body_en" label="{{__('admin.the_message_in_english')}}"  required placeholder="{{__('admin.the_message_in_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
            </div>

            <div class="col-md-12 col-12">
                <x-admin.inputs.select name="user_type" idName="send-notifications" label="{{__('admin.send_to')}}"  required placeholder="{{__('admin.Select_the_senders_category')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                    <x-slot name="options">
                        <option  value="admins">{{__('admin.admins')}}</option>
                        <option  value="all_users">{{__('admin.all_users')}}</option>
                        <option  value="active_users">{{__('admin.active_users')}}</option>
                        <option  value="not_active_users">{{__('admin.dis_active_users')}}</option>
                        <option  value="blocked_users">{{__('admin.Prohibited_users')}}</option>
                        <option  value="not_blocked_users">{{__('admin.Unspoken_users')}}</option>
                    </x-slot>
                </x-admin.inputs.select>
            </div>

            <div class="col-12">
                <x-admin.inputs.submitButton name="{{__('admin.send')}}"/>
            </div>
        </div>
    </form>

</div>