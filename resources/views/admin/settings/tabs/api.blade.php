<div id="api" class="content">
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-ajax" novalidate>
        @method('put')
        @csrf
        <input type="hidden" name="type_setting" value="api">
        <div class="row g-3">

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="google_analytics" label="{{__('admin.google_analytics')}}"  required placeholder="{{__('admin.google_analytics')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('google_analytics') }}" />
            </div>

            <div class="col-12 col-md-6">
                <x-admin.inputs.text type="text" name="google_places" label="{{__('admin.google_places')}}"  required placeholder="{{__('admin.google_places')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" value="{{ settings('google_places') }}" />
            </div>

            <div class="col-12 d-flex justify-content-center mt-3">
                <x-admin.inputs.submitButton name="{{__('admin.saving_changes')}}"/>
                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
            </div>
        </div>
    </form>
</div>
