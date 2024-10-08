@extends('admin.layout.master')

@section('content')
  <!-- // Basic multiple Column Form section start -->
  <section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ __('admin.show') }}</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="store form-horizontal">
                <div class="form-body">
                  <div class="row">

                    <div class="col-12">
                      <x-admin.inputs.image  name="image"  disabled src="{{ $admin->image }}" />
                    </div>

                    <div class="col-6">
                      <x-admin.inputs.text name="name" label="{{__('admin.name')}}"  disabled value="{{ $admin->name }}" />
                    </div>

                    <div class="col-6">
                      <x-admin.inputs.text type="number" name="phone" label="{{__('admin.phone_number')}}"  disabled value="{{ $admin->phone }}" />
                    </div>

                    <div class="col-6">
                      <x-admin.inputs.text type="email" name="email" label="{{__('admin.email')}}"  disabled value="{{ $admin->email }}" />
                    </div>


                    <div class="col-md-12 col-12">
                      <x-admin.inputs.select name="role_id" className="form-control" label="{{__('admin.Validity')}}"  disabled value="{{ optional($admin->role)->name }}"/>
                    </div>

                    <div class="col-md-12 col-12">
                      <x-admin.inputs.select disabled className="form-control" name="is_blocked" label="{{__('admin.status')}}"   value="{{ $admin->is_blocked == 1 ? __('admin.Prohibited') : __('admin.Unspoken') }}"/>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3">
                      <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>

                    </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')

@endsection
