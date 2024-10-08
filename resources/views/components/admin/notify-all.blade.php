<div class="modal fade" id="notify" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{$route}}" method="POST" enctype="multipart/form-data" class="notify-form needs-validation" novalidate>
            @csrf
            <input type="hidden" name="id" class="notify_id" value="all">
            <input type="hidden" name="notify" class="notify" value="notify">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{__('admin.Send_notification')}}</h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 col-12">
                            <x-admin.inputs.textarea name="body_ar" label="{{__('admin.the_message_in_arabic')}}"  required placeholder="{{__('admin.the_message_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                        </div>
                        <div class="col-md-12 col-12">
                            <x-admin.inputs.textarea name="body_en" label="{{__('admin.the_message_in_english')}}"  required placeholder="{{__('admin.the_message_in_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <x-admin.inputs.submitButton name="{{__('admin.send')}}"/>
                <button type="button" class="btn rounded-pill btn-secondary m-2" data-bs-dismiss="modal">{{__('admin.cancel')}}</button>
            </div>
        </div>
        </form>
    </div>
</div>





<div class="modal fade" id="mail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{$route}}" method="POST" enctype="multipart/form-data" class="notify-form needs-validation" novalidate>
        @csrf
        <input type="hidden" name="id" value="all" class="notify_id">
        <input type="hidden" name="notify" class="email" value="email">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{__('admin.Send_notification')}}</h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <x-admin.inputs.textarea name="message" label="{{__('admin.the_written_text_of_the_email')}}"  required placeholder="{{__('admin.the_written_text_of_the_email')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <x-admin.inputs.submitButton name="{{__('admin.send')}}"/>
                <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">{{__('admin.cancel')}}</button>
            </div>
        </div>
    </form>
    </div>
</div>

