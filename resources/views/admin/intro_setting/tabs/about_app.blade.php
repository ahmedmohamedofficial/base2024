<div id="about_app" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate>
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="intro_about_app">
        <div class="row g-3">
            <div class="col-6">
                <x-admin.inputs.image  name="about_image_1"  src="{{settings('about_image_1')}}" desc="{{__('admin.image_of_the_first_application')}}" />

            </div>
            <div class="col-6">
                <x-admin.inputs.image  name="about_image_2"  src="{{ settings('about_image_2')}}" desc="{{__('admin.Picture_of_the_second_application')}}" />
            </div>
            <div class="col-12">
                <x-admin.inputs.textarea name="intro_about_ar" label="{{__('admin.about_the_arabic_application')}}"  required placeholder="{{__('admin.about_the_arabic_application')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_about_ar') }}" />
            </div>
            <div class="col-12">
                <x-admin.inputs.textarea name="intro_about_en" label="{{__('admin.about_the_english_application')}}"  required placeholder="{{__('admin.about_the_english_application')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('intro_about_en') }}" />
            </div>
            <div class="col-12 d-flex justify-content-center mt-3">
                <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
            </div>
        </div>
    </form>
</div>