@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.categories.create') }}" 
    deletebutton="{{ route('admin.categories.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'parent_id' => [
            'input_type' => 'select'          , 
            'input_name' => __('admin.type') , 
            'rows'       => $categories       , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
            <a class="btn btn-info waves-effect m-2"  href="{{url(route('admin.master-export', 'Category'))}}"><i  class="fa fa-file-excel-o"></i>
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

    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/categories-show/'.$id)])
@endsection
