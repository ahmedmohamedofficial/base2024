@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    deletebutton="{{ route('admin.reports.deleteAll') }}" 
    :searchArray="[
        'subject' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.report_text') , 
        ] ,
        'ip' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.ip') , 
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
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/reports')])
    {{-- delete one user script --}}
@endsection
