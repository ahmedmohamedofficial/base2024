@extends('admin.layout.master')

@section('css')
@endsection

@section('content')

    <x-admin.table
            datefilter="true"
            order="true"
            extrabuttons="true"
            addbutton="{{ route('admin.introfqs.create') }}"
            deletebutton="{{ route('admin.introfqs.deleteAll') }}"
            :searchArray="[
                'title' => [
                    'input_type' => 'text' ,
                    'input_name' => __('admin.question') ,
                ] ,
                'description' => [
                    'input_type' => 'text' ,
                    'input_name' => __('admin.answer') ,
                ] ,
                'intro_fqs_category_id' => [
                    'input_type' => 'select' ,
                    'rows'       => $categories ,
                    'row_name'   => 'title' ,
                    'input_name' => __('admin.section') ,
                ] ,

            ]"
    >


        <x-slot name="extrabuttonsdiv">
            <a class="btn btn-info waves-effect m-2  waves-light"  href="{{url(route('admin.master-export', 'City'))}}"><i  class="fa fa-file-excel-o"></i>
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
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/introfqs')])
    {{-- delete one user script --}}
@endsection
