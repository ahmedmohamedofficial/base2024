@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

    <x-admin.table
            datefilter="true"
            order="true"
            :searchArray="[]">

        <x-slot name="tableContent">
            <div class="card table_content_append">

            </div>
        </x-slot>
    </x-admin.table>

@endsection
<x-admin.config table sweetAlert2 datePickr validation select2/>

@section('js')
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/pages')])
@endsection

