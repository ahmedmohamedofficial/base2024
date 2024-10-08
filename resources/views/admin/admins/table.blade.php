<div class="table-responsive text-nowrap">


    {{-- table content --}}
        <table class="table table-hover" id="tab">
            <thead>
                <tr>
                    <th>
                        @if ($admins->count() > 0)
                            <div class="form-check form-check-danger">
                                <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                            </div>
                        @endif
                    </th>
                    <th>#</th>
                    <th>{{ __('admin.image') }}</th>
                    <th>{{ __('admin.name') }}</th>
                    <th>{{ __('admin.email') }}</th>
                    <th>{{ __('admin.phone') }}</th>
                    <th>{{ __('admin.status') }}</th>
                    <th>{{ __('admin.created_at') }}</th>
                    <th>{{ __('admin.control')  }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="delete_row">
                    <td class="text-center">
                        @if ($admin->id != 1 && auth()->id() != $admin->id)
                            <div class="form-check form-check-danger">
                                <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$admin->id}}">
                            </div>
                        @else
                        *
                        @endif
                    </td>
                        <td>{{$loop->iteration}}</td>
                    <td>
                        <img src="{{ $admin->avatar }}" width="50px" height="50px"
                            alt="image">
                    </td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->full_phone }}</td>
                    <td>
                        @if ($admin->id != 1)
                            @if ($admin->is_blocked)
                                <span class="btn btn-sm round btn-outline-danger">
                                    {{ __('admin.Prohibited')  }} <i class="la la-close font-medium-2"></i>
                                </span>
                                <span class="btn btn-sm round btn-outline-success block_user" data-id="{{$admin->id}}">{{__('admin.unblock')}}</span>
                            @else
                                <span class="btn btn-sm round btn-outline-success">
                                    {{ __('admin.Unspoken') }} <i class="la la-check font-medium-2"></i>
                                </span>
                                <span class="btn btn-sm round btn-outline-danger block_user" data-id="{{$admin->id}}">{{__('admin.block')}}</span>
                            @endif
                        @else
                                --
                        @endif
                    </td>
                    <td>{{ $admin->created_at_format }}</td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary" href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn rounded-pill btn-primary" href="{{ route('admin.admins.show', ['id' => $admin->id]) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if ($admin->id != 1 && auth()->id() != $admin->id)
                            <span class="delete-row btn rounded-pill btn-danger"
                                    data-url="{{ url('admin/admins/' . $admin->id) }}">
                                <i class="fa fa-trash"></i>
                            </span>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{-- table content --}}
    {{-- no data found div --}}
        @if ($admins->count() == 0)
            <x-admin.empty/>
        @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$admins"/>

{{-- pagination  links div --}}