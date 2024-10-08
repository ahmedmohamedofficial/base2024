<div id="texts" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate>
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="intro_texts">

        <div class="row g-3">
            <div class="col-12">
                <x-admin.inputs.textarea name="services_text_ar" label="{{__('admin.address_of_our_services_section_in_arabic')}}"  required placeholder="{{__('admin.address_of_our_services_section_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('services_text_ar') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="services_text_en" label="{{__('admin.the_title_of_our_english_service_department')}}"  required placeholder="{{__('admin.the_title_of_our_english_service_department')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('services_text_en') }}" />
            </div>
            <div class="col-12">
                <x-admin.inputs.textarea name="how_work_text_ar" label="{{__('admin.the_title_of_how_the_site_works_in_arabic')}}"  required placeholder="{{__('admin.the_title_of_how_the_site_works_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('how_work_text_ar') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="how_work_text_en" label="{{__('admin.the_title_of_the_section_of_how_the_english_site_works')}}"  required placeholder="{{__('admin.the_title_of_the_section_of_how_the_english_site_works')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('how_work_text_en') }}" />
            </div>
            <div class="col-12">
                <x-admin.inputs.textarea name="fqs_text_ar" label="{{__('admin.the_address_of_the_questions_section_in_arabic')}}"  required placeholder="{{__('admin.the_address_of_the_questions_section_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('fqs_text_ar') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="fqs_text_en" label="{{__('admin.the_address_of_the_questions_section_english')}}"  required placeholder="{{__('admin.the_address_of_the_questions_section_english')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('fqs_text_en') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="parteners_text_ar" label="{{__('admin.the_title_of_our_partition_in_arabic')}}"  required placeholder="{{__('admin.the_title_of_our_partition_in_arabic')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('parteners_text_ar') }}" />
            </div>
            <div class="col-12">
                <x-admin.inputs.textarea name="parteners_text_en" label="{{__('admin.the_title_of_our_english_partition')}}"  required placeholder="{{__('admin.the_title_of_our_english_partition')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('parteners_text_en') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="contact_text_ar" label="{{__('admin.address_in_arabic_communication')}}"  required placeholder="{{__('admin.address_in_arabic_communication')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('contact_text_ar') }}" />
            </div>

            <div class="col-12">
                <x-admin.inputs.textarea name="contact_text_en" label="{{__('admin.address_in_english_communication')}}"  required placeholder="{{__('admin.address_in_english_communication')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('contact_text_en') }}" />
            </div>

            <div class="col-12 d-flex justify-content-center mt-3">
                <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
            </div>
        </div>
    </form>
</div>