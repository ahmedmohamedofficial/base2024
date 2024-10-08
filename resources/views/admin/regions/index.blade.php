@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')
<div class="content-body">

    <div class="mb-1 d-flex justify-content-between m-0">

        <x-admin.buttons 
            extrabuttons="true"
            addbutton="{{ route('admin.regions.create') }}" 
            deletebutton="{{ route('admin.regions.deleteAll') }}" 
        >
            <x-slot name="extrabuttonsdiv">
                <a class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light"  href="{{url(route('admin.master-export', 'Region'))}}"><i  class="fa fa-file-excel-o"></i>
                    {{ __('admin.export') }}</a>
            </x-slot>
        </x-admin.buttons>


        <x-admin.filter 
            datefilter="true" 
            order="true" 
            :searchArray="[
                'name' => [
                    'input_type' => 'text' , 
                    'input_name' => __('admin.name') , 
                ] ,
        
                'country_id' => [
                    'input_type' => 'select' , 
                    'rows'       => $countries , 
                    'input_name' => __('admin.country') , 
                ] ,
                
            ]"
        />

    </div>

    <div class="table_content_append">
        
    </div>
</div>
    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/regions')])
@endsection
