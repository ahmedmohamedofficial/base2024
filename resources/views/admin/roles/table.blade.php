<div class="table-responsive text-nowrap">

    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.created_at')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr class="delete_role">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->created_at_format}}</td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.roles.edit' , ['id' => $role->id])}}"><i class="fa fa-edit"></i></a>
                        @if(auth()->guard('admin')->user()->role_id != $role->id)
                            <span class="delete-row btn rounded-pill btn-danger m-2" data-url="{{url('admin/roles/'.$role->id)}}"><i class="fa fa-trash"></i></span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($roles->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$roles"/>

{{-- pagination  links div --}}