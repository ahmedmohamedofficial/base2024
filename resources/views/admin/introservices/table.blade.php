<div class="table-responsive text-nowrap">
    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($services->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif
                </th>
                <th>#</th>
                <th>{{__('admin.address') }}</th>
                <th>{{__('admin.created_at') }}</th>
                <th>{{__('admin.control') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr class="delete_service">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$service->id}}">
                        </div>
                    </td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$service->title}}</td>
                    <td>{{$service->created_at_format}}</td>
                    <td class="product-action">
                        <span class="text-primary"><a class="btn rounded-pill btn-primary" href="{{route('admin.introservices.show' , ['id' => $service->id])}}"><i class="fa fa-eye"></i></a></span>
                        <span class="action-edit text-primary"><a class="btn rounded-pill btn-primary" href="{{route('admin.introservices.edit' , ['id' => $service->id])}}"><i class="fa fa-edit"></i></a></span>
                        <span class="delete-row btn rounded-pill btn-danger" data-url="{{url('admin/introservices/'.$service->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($services->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$services"/>

{{-- pagination  links div --}}