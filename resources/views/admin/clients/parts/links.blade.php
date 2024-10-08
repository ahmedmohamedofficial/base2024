<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('/') }}dashboard/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ $row->avatar }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ $row->name }}</h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2 show-details-links">
                                <li class="list-inline-item d-flex gap-1">
                                    <a data-href="{{ route('admin.clients.show' , ['id' =>$row->id , 'type' => 'main_data']) }}"  class="nav-link font-small-3">{{ __('admin.main_data') }} </a>
                                </li>

                                <li class="list-inline-item d-flex gap-1">
                                    <a data-href="{{ route('admin.clients.show' , ['id' =>$row->id , 'type' => 'complaints']) }}"  class="nav-link font-small-3">{{ __('admin.complaints') }} ( {{ $row->complaints()->count() }} )</a>
                                </li>

                                <li class="list-inline-item d-flex gap-1">
                                    <a data-href="{{ route('admin.clients.show' , ['id' =>$row->id , 'type' => 'wallet']) }}"  class="nav-link font-small-3">{{ __('admin.wallet') }} (<span class="text-success available_balance"> {{ round($row->wallet->available_balance ) . ' ' . __('site.currency')}}  </span>)</a>
                                </li>

                                <li class="list-inline-item d-flex gap-1">
                                    <a data-href="{{ route('admin.clients.show' , ['id' =>$row->id , 'type' => 'orders']) }}"  class="nav-link font-small-3">{{ __('admin.orders') }} ( {{ round($row->orders()->count() ) }} )</a>
                                </li>

                            </ul>
                        </div>

                        <div class="">
                            <a href="{{ route('admin.clients.edit', $row->id) }}"
                               class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button" data-url="{{ route('admin.clients.delete', $row->id) }}"
                                    class="btn btn-icon btn-icon rounded-circle btn-danger delete-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

