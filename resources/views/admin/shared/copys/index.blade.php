@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.copys.create') }}" 
    deletebutton="{{ route('admin.copys.deleteAll') }}" 
    :searchArray="[]">

    <x-slot name="extrabuttonsdiv">
        <a class="btn btn-info waves-effect m-2  waves-light exportExcel" href="{{route('admin.copys.export')}}"><i class="fa fa-file-excel"></i>
            {{ __('admin.export') }}</a>
    </x-slot>

    <x-slot name="tableContent">
        <div class="card table_content_append">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>
</x-admin.table>


    
@endsection
<x-admin.config table sweetAlert2 datePickr/>

@section('js')

    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/copys')])
@endsection
