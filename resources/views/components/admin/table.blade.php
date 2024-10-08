<div class="content-bodyz">
    <div class="table_buttons mb-1">
        <div class="row m-0 justify-content-between">
            <div>
                @isset($addbutton)
                    <a href="{{$addbutton}}" class="btn btn-primary waves-effect waves-light m-2" ><i class="fa fa-plus"></i> {{__('admin.add')}}</a>
                @endisset
                @isset($deletebutton)
                    <button type="button" data-route="{{$deletebutton}}" class="btn btn-danger waves-effect waves-light m-2 delete_all_button d-none"><i class="fa fa-trash"></i> {{__('admin.delete_selected')}}</button>
                @endisset
                @isset($extrabuttons)
                    {{$extrabuttonsdiv}}
                @endif
                <button type="button" class="reload btn btn-warning waves-effect waves-light m-2"><i class="fa fa-refresh"></i> {{__('admin.refresh')}}</button>
                <button
                        class="btn btn-outline-vimeo waves-effect m-2"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasEnd"
                        aria-controls="offcanvasEnd">
                    <i class="fa fa-filter"></i>
                    {{  __('admin.filter') }}
                </button>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="mt-3">
            <div
                    class="offcanvas offcanvas-end"
                    tabindex="-1"
                    id="offcanvasEnd"
                    aria-labelledby="offcanvasEndLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasEndLabel" class="offcanvas-title">{{  __('admin.filter_according') }} :</h5>
                    <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>
                <div class="offcanvas-body my-auto mx-0">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="first-name-column">{{ __('site.search') }}</label>
                                    <div class="form-controls">
                                        <i class="fa fa-times clear-input"></i>
                                        <input type="text" name="q" class="form-control searchInput " placeholder="{{ __('site.search') . " ..." }}">
                                    </div>
                                </div>
                            </div>
                            @isset($order)
                                <div class="col-md-12 col-12">
                                    <x-admin.inputs.select className="select2 form-select form-select-lg select2-hidden-accessible searchInput" name="order" label="{{__('admin.sort_by')}}"  placeholder="{{__('admin.choose')}}" >
                                        <x-slot name="options">
                                            <option value>{{ __('admin.choose') }}</option>
                                            <option value="ASC">{{ __('admin.Progressive') }}</option>
                                            <option value="DESC" selected>{{ __('admin.descending') }}</option>
                                        </x-slot>
                                    </x-admin.inputs.select>
                                </div>
                            @endisset
                            @isset($datefilter)
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="first-name-column">{{ __('admin.beginning_date') }}</label>
                                        <div class="form-controls" id="start">
                                            <input type="date"  name="created_at_min" class="form-control searchInput" data-input placeholder="{{ __('admin.beginning_date') }}">
                                            <i class="fa fa-times clear-input" data-clear></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="first-name-column">{{ __('admin.end_date') }}</label>
                                        <div class="form-controls" id="end">
                                            <input type="date"  name="created_at_max" class="form-control searchInput" data-input placeholder="{{ __('admin.end_date') }}">
                                            <i class="fa fa-times clear-input" data-clear></i>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            @isset($searchArray)
                                @foreach ($searchArray as $key => $value)
                                    <div class="col-12">
                                        <div class="mb-3">
                                            @isset($value['input_name'])
                                            <label for="first-name-column">{{ $value['input_name'] }}</label>
                                            @endisset
                                            <div class="@if ($value['input_type'] == 'text') form-controls @endif">
                                                @if ($value['input_type'] == 'text')
                                                    <i class="fa fa-times clear-input"></i>
                                                    <input type="text" name="{{ $key }}" class="form-control searchInput " placeholder="{{ __('site.write') . $value['input_name'] }}">
                                                @elseif ($value['input_type'] == 'select')
                                                    <x-admin.inputs.select className="select2 form-select form-select-lg select2-hidden-accessible searchInput" name="{{ $key }}"    >
                                                        <x-slot name="options">
                                                            <option value>{{ __('admin.choose') }}</option>
                                                            @foreach ($value['rows'] as $row)
                                                                <option value="{{ $row['id'] }}">
                                                                    {{ isset($value['row_name']) ? $row[$value['row_name']] : $row['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </x-slot>
                                                    </x-admin.inputs.select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="searchTable">
    </div>

    <div class="layout_"></div>

    {{$tableContent}}
</div>