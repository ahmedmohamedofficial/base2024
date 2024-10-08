@extends('admin.layout.master')

@section('css')
@endsection

@section('content')
    <x-admin.table
    datefilter="true" 
    order="true" 
    addbutton="{{ route('admin.introsliders.create') }}" 
    deletebutton="{{ route('admin.introsliders.deleteAll') }}" 
    :searchArray="[
        'title' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.address') , 
        ] ,
        'description' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.description') , 
        ] ,
        
    ]" 
>
    <x-slot name="tableContent">
        <div class="card table_content_append ">

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
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/introsliders')])
    {{-- delete one user script --}}
@endsection
