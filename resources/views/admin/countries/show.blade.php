@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.show')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  class="store form-horizontal" >
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <x-admin.inputs.image  name="image"  disabled src="{{ $country->image }}" />
                                        </div>

                                        @foreach (languages() as $lang)
                                            <div class="col-md-4 col-12">
                                                <x-admin.inputs.text name="name[{{$lang}}]" label="{{__('site.name_'.$lang)}}"  disabled value="{{ $country->getTranslation('name', $lang) }}" />
                                            </div>
                                        @endforeach

                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="country_code" type="number" label="{{__('admin.country_code')}}"  disabled value="{{ $country->country_code }}" />
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <x-admin.inputs.text name="iso2" type="number" label="ISO"  disabled value="{{ $country->iso2 }}" />
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
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