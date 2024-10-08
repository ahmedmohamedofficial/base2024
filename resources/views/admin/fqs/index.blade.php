@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    addbutton="{{ route('admin.fqs.create') }}" 
    deletebutton="{{ route('admin.fqs.deleteAll') }}" 
    :searchArray="[
        'question' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.question') , 
        ] ,
        'answer' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.answer') , 
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
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/fqs')])
    {{-- delete one user script --}}
@endsection
