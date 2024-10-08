@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="category match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.show')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="store form-horizontal">
                                <div class="form-body">
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <x-admin.inputs.image  name="image" src="{{ $category->image }}"  disabled/>
                                            </div>

                                            @foreach (languages() as $lang)
                                                <div class="col-md-6 col-12">
                                                    <x-admin.inputs.text name="name[{{$lang}}]" value="{{ $category->getTranslation('name', $lang) }}" label="{{__('site.name_'.$lang)}}"  disabled />
                                                </div>
                                            @endforeach

                                            @if($category->parent)
                                                <div class="col-md-12 col-12">
                                                    <x-admin.inputs.select className="form-control" name="parent_id" label="{{__('admin.section')}}"  disabled value="{{ $category->parent->name }}"/>
                                                </div>
                                            @endif

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                            </div>

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