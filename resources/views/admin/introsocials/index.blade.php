@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    addbutton="{{ route('admin.introsocials.create') }}" 
    deletebutton="{{ route('admin.introsocials.deleteAll') }}" 
    :searchArray="[
        'key' => [
            'input_type' => 'text' , 
            'input_name' =>__('admin.name_of_socials') , 
        ] ,
        'icon' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.text_of_icon') , 
        ] ,
        'url' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.Link'), 
        ] ,
        
    ]" 
>
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
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/introsocials')])
    {{-- delete one user script --}}
@endsection
