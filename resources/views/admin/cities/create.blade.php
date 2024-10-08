@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')

@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.add')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.cities.store')}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="name[{{$lang}}]" label="{{__('site.name_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.name_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 col-12">
                                        <x-admin.inputs.select name="region_id" label="{{__('admin.region')}}"  required placeholder="{{__('admin.choose_the_region')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                            <x-slot name="options">
                                                @foreach ($regions as $region)
                                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                                @endforeach
                                            </x-slot>
                                        </x-admin.inputs.select>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <x-admin.inputs.submitButton name="{{__('admin.add')}}"/>
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
<x-admin.config sweetAlert2 validation select2/>

@section('js')

    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
    <x-admin.inputs.formAjax className="store"/>
    {{-- submit add form script --}}
    
@endsection