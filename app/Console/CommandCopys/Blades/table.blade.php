<div class="table-responsive text-nowrap">


    {{-- table content --}}
    <table class="table table-hover">
        <thead>
        <tr>
            <th>
                @if ($copys->count() > 0)
                    <div class="form-check form-check-danger">
                        <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                    </div>
                @endif
            </th>
            <th>{{__('admin.image')}}</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.email')}}</th>
            <th>{{__('admin.phone')}}</th>
            <th>{{__('admin.ban_status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($copys as $copy)
            <tr class="delete_row">
                <td class="text-center">
                    <div class="form-check form-check-danger">
                        <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$copy->id}}">
                    </div>
                </td>
                <td><img src="{{$copy->image}}" width="50px" height="50px" alt=""></td>
                <td>{{ $copy->name }}</td>
                <td>{{ $copy->email }}</td>
                <td>{{ $copy->phone }}</td>
                <td>
                    @if ($copy->is_blocked)
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ __('admin.Prohibited') }} <i class="la la-close font-medium-2"></i>
                        </span>
                    @else
                        <span class="btn btn-sm round btn-outline-success">
                            {{ __('admin.Unspoken') }} <i class="la la-check font-medium-2"></i>
                        </span>
                    @endif
                </td>

                <td class="product-action">
                    <a class="btn rounded-pill btn-primary m-2" href="{{ route('admin.copys.show', ['id' => $copy->id]) }}"><i class="fa fa-eye"></i></a>
                    <a class="btn rounded-pill btn-primary m-2" href="{{ route('admin.copys.edit', ['id' => $copy->id]) }}"><i class="fa fa-edit"></i></a>
                    <span class="delete-row btn rounded-pill btn-danger m-2" data-url="{{ url('admin/copys/' . $copy->id) }}"><i class="fa fa-trash"></i></span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($copys->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($copys->count() > 0 && $copys instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$copys->links()}}
    </div>
@endif
{{-- pagination  links div --}}

