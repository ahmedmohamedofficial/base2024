@extends('admin.layout.master')
@section('css')


@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.edit')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('admin.roles.update',$role->id)}}" method="post" class="needs-validation" novalidate>
                                @method('put')
                                @csrf
                                <div class="container mt-2">
                                    <div style="display: flex; flex-direction: row-reverse; align-items: center">
                                        <label class="switch switch-info">
                                            <input type="checkbox" class="switch-input"   id="checkedAll"  >
                                            <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                            <span class="switch-label">{{__('admin.select_all')}}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach (languages() as $lang)
                                        <div class="col-md-6 col-12">
                                            <x-admin.inputs.text name="name[{{$lang}}]" value="{{ $role->getTranslation('name', $lang) }}" label="{{__('site.name_'.$lang)}}"  required placeholder="{{__('site.write') . __('site.name_'.$lang)}}"  inValidMessage="{{ __('admin.this_field_is_required') }}" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="container mt-2">
                                    <div class="row">
                                        @foreach (config('permissions') as $routeKey => $value)
                                            @if (isset($value['as']))
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="card overflow-hidden mb-4" style="height: 360px">
                                                        <div class="card-header bg-primary text-white header-elements">

                                                        <span class="me-2">

                                                             <label class="switch switch-info"  for="gtx_{{$routeKey}}">
                                                                 <input type="checkbox" class="switch-input" name="permissions[]" data-parent="gtx_{{$routeKey}}" value="{{$value['as']}}" id="gtx_{{$routeKey}}" {{in_array($routeKey, $my_routes)  ? 'checked' : ''}} >
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label text-white">{{__('routes.admin.'.$value["as"]) }}</span>
                                                            </label>

                                                        </span>

                                                            <div class="card-header-elements ms-auto">
                                                                <label class="switch switch-info" data-parent="gtx_{{$routeKey}}">
                                                                    <input type="checkbox" class="switch-input checkChilds checkChilds_gtx_{{$routeKey}}" name="permissions[]" data-parent="gtx_{{$routeKey}}" value="{{ isset($value['as']) ? 'admin.'.$value['as'] : '' }}">
                                                                    <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                    <span class="switch-label text-white">{{__('admin.select_all')}}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="card-body vertical-example contentHolder" id="">
                                                            @if (isset($value['child']) && count($value['child']))
                                                                @foreach ($value['child'] as $key => $child)
                                                                    @php $routeName = is_int($key) ? 'admin.' . $value['child'][$key] : 'admin.' . $key @endphp
                                                                    <div class="form-check form-check-success mt-3 p-0">
                                                                        <label class="switch switch-info"  for="{{$routeName . $key}}">
                                                                            <input type="checkbox" class="switch-input childs  checkChilds_gtx_{{$routeKey}} gtx_{{$routeKey}}" name="permissions[]" data-parent="gtx_{{$routeKey}}" value="{{ $routeName }}"  id="{{$routeName . $key}}" {{in_array('admin.' . $routeName, $my_routes)  ? 'checked' : ''}} >
                                                                            <span class="switch-toggle-slider">
                                                                            <span class="switch-on"></span>
                                                                            <span class="switch-off"></span>
                                                                        </span>
                                                                            <span class="switch-label">{{ __('routes.' . $routeName) }} </span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <span class="text-danger position-absolute" style="top:50% ; left: 32%;">
                                                                {{__('admin.no_sub_routes')}}
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn rounded-pill btn-primary m-2 submit_button">{{__('admin.update')}}</button>
                                    <a href="{{ url()->previous() }}" type="reset" class="btn rounded-pill btn-outline-warning m-2">{{__('admin.back')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<x-admin.config sweetAlert2 validation scrollbar/>

@section('js')
    <script>
        $(function () {
            $('.checkChilds').each(function () {
                var childClass =  $(this).data('parent');
                console.log($('#'+childClass).prop("checked"));
                var count = 0

                $("."+childClass).each(function() {
                    if (!this.checked) {
                        count = count + 1
                    }
                });

                if (!$('#'+childClass).prop("checked")) {
                    count = count + 1
                }

                if (count > 0 ) {
                    $(this).prop('checked' , false)
                }else{
                    $(this).prop('checked' , true)
                }

            });



            $('.roles-parent').change(function (e) {
                var id =  $(this).attr('id');
                if (!this.checked) {
                    var count = 0
                    $("."+id).each(function() {
                        if (this.checked) {
                            count = count + 1
                        }
                    });

                    if (count > 0 ) {
                        $('#'+id).prop('checked' , true)
                    }else{
                        $('#'+id).prop('checked' , false)
                    }
                }
            });
            $('.checkChilds').change(function () {
                var childClass =  $(this).data('parent');
                if (this.checked) {
                    $('.' +childClass).prop("checked", true);
                    $('#' +childClass).prop("checked", true);
                } else {
                    $('.' +childClass).prop("checked", false);
                    $('#' +childClass).prop("checked", false);
                }
            });

            $('.childs').change(function () {
                var parent =  $(this).data('parent');
                if (this.checked) {
                    $('#' +parent).prop("checked", true);
                    var count = 0
                    $("."+parent).each(function() {
                        if (! this.checked) {
                            count = count + 1
                        }
                    });
                    if (count > 0 ) {
                        $('.checkChilds_'+parent).prop('checked' , false)
                    }else{
                        $('.checkChilds_'+parent).prop('checked' , true)
                    }
                }else{
                    $('.checkChilds_'+parent).prop('checked' , false)
                }
            });
        });


        $("#checkedAll").change(function () {
            if (this.checked) {
                $("input[type=checkbox]").each(function () {
                    this.checked = true
                })
            } else {
                $("input[type=checkbox]").each(function () {
                    this.checked = false;
                })
            }
        });
    </script>
@endsection

