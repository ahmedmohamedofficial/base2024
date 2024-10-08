@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.countries.create') }}" 
    deletebutton="{{ route('admin.countries.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ],
        'key' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.country_code') , 
        ],
        
    ]" 
>

    <x-slot name="extrabuttonsdiv">
            <a class="btn btn-info waves-effect m-2  waves-light"  href="{{url(route('admin.master-export', 'Country'))}}"><i  class="fa fa-file-excel-o"></i>
                {{ __('admin.export') }}</a>
    </x-slot>
    <x-slot name="tableContent">
        <div class="card table_content_append">

        </div>
    </x-slot>
</x-admin.table>


    
@endsection
<x-admin.config table sweetAlert2 datePickr/>

@section('js')

    {{-- delete all script --}}
        @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
        @include('admin.shared.deleteOne')
    {{-- delete one user script --}}

    {{-- delete one user script --}}
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/countries')])
    {{-- delete one user script --}}
@endsection
