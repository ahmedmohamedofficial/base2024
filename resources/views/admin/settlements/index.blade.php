
@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    :searchArray="[
        'providerable_type' => [
            'input_type' => 'select' ,
            'rows'       => [
              1 => [
                'name' => __('enums.guards.provider') ,
                'id' => 'App\Models\Provider' ,
              ]
            ] ,
            'input_name' => __('admin.provider_type') ,
        ],
         'type' => [
            'input_type' => 'select' ,
            'rows'       => [
              0 => [
                'name' => __('enums.settlements_type.due') ,
                'id' => 'due' ,
              ],
            1 => [
                'name' => __('enums.settlements_type.indebtedness') ,
                'id' => 'indebtedness' ,
              ],
            ] ,
            'input_name' => __('admin.settlements_type') ,
        ],
         'status' => [
            'input_type' => 'select' ,
            'rows'       =>  $status,
            'input_name' => __('admin.settlements_status') ,
        ],

    ]"
>
    <x-slot name="tableContent">
        <div class="card table_content_append">

        </div>
    </x-slot>
</x-admin.table>
@include('admin.settlements.items.accept_modal')
@include('admin.settlements.items.cancel_modal')

    
@endsection
<x-admin.config table sweetAlert2 datePickr validation/>

@section('js')

    {{-- delete all script --}}
        @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
        @include('admin.shared.deleteOne')
    {{-- delete one user script --}}

    {{-- Upload Image script --}}
    @include('admin.shared.addImage')
    {{-- Upload Image script --}}
    <script>
        $(document).on('click', '.accept-btn', function () {
            var id = $(this).data('id'),
                amount = $(this).data('amount')
            $('.settlement_id').val(id)
            $('#amount').html(amount + ' {{__('apis.currency')}}')
        });

        $(document).on('click', '.cancel-btn', function () {
            var id = $(this).data('id')
            $('.settlement_id').val(id)
        });
    </script>
    <x-admin.inputs.formAjax className="formAjax"/>


    {{-- submit add form script --}}
    {{-- submit add form script --}}

    {{-- delete one user script --}}
        @include('admin.shared.filter_js' , [ 'index_route' => url('admin/settlements')])
    {{-- delete one user script --}}
@endsection
