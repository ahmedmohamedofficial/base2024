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
                        <form  method="POST" action="{{route('admin.categories.store')}}" class="store form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <x-admin.inputs.image  name="image"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                    </div>


                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="name[{{$lang}}]" label="{{__('site.name_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.name_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach


                                    @if ($id == null)
                                        <div class="col-md-12 col-12">
                                            <x-admin.inputs.select name="parent_id" label="{{__('admin.select_main_section')}}"  required placeholder="{{__('admin.select_as_main_section')}}"  inValidMessage="{{ __('admin.this_field_is_required') }}">
                                                <x-slot name="options">
                                                    <option value>{{__('admin.select_as_main_section')}}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-admin.inputs.select>
                                        </div> 
                                    @else
                                        <input type="hidden" name="parent_id" value="{{$id}}">
                                    @endif



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