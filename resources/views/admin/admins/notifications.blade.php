@extends('admin.layout.master')

@section('css')

@endsection
    
@section('content')

    <div class="row">
        @if (auth('admin')->user()->notifications->count() > 0)
            <div class="col-12 app-action">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title header-elements">
                            <h5 class="m-0 me-2">
                                <label class="switch switch-danger selectAll">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span> <span class="switch-label">{{__('admin.select_all')}}</span> </label>
                                </h5>

                            <div class="card-title-elements ms-auto">
                                <button type="button" class="btn rounded-pill btn-danger delete_all_button"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @foreach (auth('admin')->user()->notifications as $notification)
                <div class="col-12 notify-read">
                    <div class="card mb-4">
                        <div class="card-body pt-2">
                            <div class="card-title header-elements">
                                <h5 class="m-0 me-1">{{$notification->title}}</h5>
                                <div class="card-header-elements ms-auto">
                                    <span class="tf-icon ti-xs ti ti-bell"></span>
                                    <span class="text text-muted d-flex">
                                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </span>

                                    <span class="text text-muted d-flex m-3">
                                        <label class="switch switch-danger checkSingle">
                                    <input type="checkbox" class="switch-input" id="{{ $notification->id }}">
                                    <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span> <span class="switch-label"></span> </label>
                                    </span>
                                </div>
                            </div>
                            <p class="card-text">{{ $notification->body }}</p>
                        </div>
                    </div>
                </div>
        @endforeach
            <div class="no-data" style="display: none">
                <x-admin.empty/>
            </div>


    </div>

@endsection
<x-admin.config sweetAlert2/>


@section('js')


    <script>
        $('#countNotify').text('0');
        $(document).on('change' , '.selectAll input', function () {
            if(this.checked){
                    $(".checkSingle input").each(function(index, element){
                        $(this).prop('checked', true)
                    })
                }else{
                    $(".checkSingle input").each(function(){
                        $(this).prop('checked', false)
                    })
                }
        });
        $(document).on('change' , '.checkSingle input', function () {
            if(! this.checked){
                $('.selectAll input').prop('checked', false)
            }else{
                var isAllChecked = 0;
                $(".checkSingle input").each(function(){
                    if(!this.checked)
                        isAllChecked = 1;
                })
                if(isAllChecked == 0){ $('.selectAll input').prop("checked", true); }
            }
        });
    </script>
    @if (auth('admin')->user()->notifications->count() > 0)
        <script>
            $('.no-data').fadeOut()
        </script>
    @else
        <script>
            $('.no-data').fadeIn()
        </script>
    @endif
    <script>
        $('.delete_all_button').on('click', function (e) {
            e.preventDefault()
            Swal.fire({
                title: "{{__('هل تريد الاستمرار ؟')}}",
                text: "{{__('هل انت متأكد انك تريد استكمال عملية حذف المحدد')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{__('admin.confirm')}}',
                cancelButtonText: '{{__('admin.cancel')}}',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-primary'
                },
                buttonsStyling: false
                }).then( (result) => {
                if (result.value) {
                    var usersIds = [];
                    $('.checkSingle input:checked').each(function () {
                        var id = $(this).attr('id');
                        usersIds.push({
                            id: id,
                        });
                    });

                    var requestData = JSON.stringify(usersIds);
                    if (usersIds.length > 0) {
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: '{{route("admin.admins.notifications.delete")}}',
                            data: {data : requestData},
                            
                            success: function( msg ) {
                                Swal.fire(
                                {
                                    position: 'top-start',
                                    icon: 'success',
                                    title: '{{__('admin.the_selected_has_been_successfully_deleted')}}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })

                                
                                $('.checkSingle input:checked').each(function () {
                                    $(this).parents('.notify-read').remove().fadeOut()
                                });

                                if ($(".checkSingle input").length  == 0 ) {
                                    $('.no-data').fadeIn()
                                    $('.app-action').remove()
                                }
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection

