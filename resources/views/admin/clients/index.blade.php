@extends('admin.layout.master')

@section('css')

@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.clients.create') }}" 
    deletebutton="{{ route('admin.clients.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ],
        'phone' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.phone') , 
        ] ,
        'email' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.email') , 
        ] ,
        'is_blocked' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => 'محظور' , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => 'غير محظور' , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.ban_status') , 
        ] ,
        'active' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => 'مفعل' , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => 'غير مفعل' , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.phone_activation_status')  , 
        ] ,
        
    ]" 
>
  <x-slot name="extrabuttonsdiv">
    <button type="button" data-bs-toggle="modal" data-bs-target="#notify" class="btn btn-info waves-effect waves-light notify m-2" data-id="all"><i class="fa fa-bell"></i> {{ __('admin.Send_notification') }}</button>
    <button type="button" data-bs-toggle="modal" data-bs-target="#mail"
      class="btn btn-success waves-effect m-2  waves-light mail"
      data-id="all"><i class="fa fa-envelope"></i> {{ __('admin.Send_email') }}</button>
    <a class="btn btn-info waves-effect m-2  waves-light"  href="{{url(route('admin.master-export', 'User'))}}"><i  class="fa fa-file-excel"></i>
        {{ __('admin.export') }}</a>
  </x-slot>

    <x-slot name="tableContent">
        <div class="card table_content_append">

        </div>
    </x-slot>
</x-admin.table>
  {{-- notify users model --}}
  <x-admin.NotifyAll route="{{ route('admin.clients.notify') }}" />
  {{-- notify users model --}}
@endsection
<x-admin.config table sweetAlert2 datePickr validation select2/>

@section('js')
    <x-admin.inputs.formAjax className="notify-form"/>

    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/clients')])
    <script>
        $(document).on('click' , '.mail' , function (e) {
            $('.notify_id').val($(this).data('id'))
        })
        $(document).on('click' , '.notify' , function (e) {
            $('.notify_id').val($(this).data('id'))
        })
      $(document).ready(function(){
          $(document).on('click','.block_user',function(e){
              e.preventDefault();
              $.ajax({
                  url: '{{route("admin.clients.block")}}',
                  method: 'post',
                  data: { id : $(this).data('id')},
                  dataType:'json',
                  beforeSend: function(){
                      $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disable',true)
                  },
                  success: function(response){
                      Swal.fire({
                                  position: 'top-start',
                                  icon: 'success',
                                  title: response.message,
                                  showConfirmButton: false,
                                  timer: 1500,
                                  confirmButtonClass: 'btn btn-primary',
                                  buttonsStyling: false,
                              })
                      setTimeout(function(){
                          getData()
                      }, 1000);
                  },
              });
  
          });
      });
  </script>
@endsection
