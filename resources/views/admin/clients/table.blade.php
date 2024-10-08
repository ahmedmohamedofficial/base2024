<div class="table-responsive text-nowrap">

    
    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($rows->count() > 0)
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
                <th>{{ __('admin.ban_status') }}</th>
                <th>{{ __('admin.activation') }}</th>
                <th>{{ __('admin.created_at') }}</th>
                <th>{{ __('admin.control') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="delete_row">
                <td class="text-center">
                    <div class="form-check form-check-danger">
                        <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$row->id}}">
                    </div>
                </td>
                    <td>{{$loop->iteration}}</td>
                <td><img src="{{$row->avatar}}" width="50px" height="50px" alt=""></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>
                    @if ($row->is_blocked)
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ __('admin.Prohibited')  }} <i class="la la-close font-medium-2"></i>
                        </span>
                        <span class="btn btn-sm round btn-outline-success block_user" data-id="{{$row->id}}">{{__('admin.unblock')}}</span>
                    @else
                        <span class="btn btn-sm round btn-outline-success">
                            {{ __('admin.Unspoken') }} <i class="la la-check font-medium-2"></i>
                        </span>
                        <span class="btn btn-sm round btn-outline-danger block_user" data-id="{{$row->id}}">{{__('admin.block')}}</span>
                    @endif
                </td>
                <td>
                    @if ($row->active)
                    <span class="btn btn-sm round btn-outline-success">
                        {{ __('admin.activate') }} <i class="la la-close font-medium-2"></i>
                    </span>
                    @else
                    <span class="btn btn-sm round btn-outline-danger">
                        {{ __('admin.dis_activate') }} <i class="la la-check font-medium-2"></i>
                    </span>
                    @endif
                </td>
                <td>{{ $row->created_at_format }}</td>
                <td class="product-action">
                    <a class="btn rounded-pill btn-primary" href="{{ route('admin.clients.show', ['id' => $row->id]) }}"><i class="fa fa-eye"></i></a>
                    <a class="btn rounded-pill btn-primary" href="{{ route('admin.clients.edit', ['id' => $row->id]) }}"><i class="fa fa-edit"></i></a>
                    <span data-bs-toggle="modal" data-bs-target="#notify" class="btn rounded-pill btn-info notify"
                        data-id="{{ $row->id }}"
                        data-url="{{ url('admins/clients/notify') }}"><i
                        class="fa fa-bell"></i></span>
                    <span data-bs-toggle="modal" data-bs-target="#mail" class="btn rounded-pill btn-info mail"
                        data-id="{{ $row->id }}"
                        data-url="{{ url('admins/clients/notify') }}"><i
                        class="fa fa-envelope"></i></span>
                    <span class="delete-row btn rounded-pill btn-danger"
                        data-url="{{ url('admin/clients/' . $row->id) }}"><i
                        class="fa fa-trash"></i></span>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($rows->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$rows"/>

{{-- pagination  links div --}}

