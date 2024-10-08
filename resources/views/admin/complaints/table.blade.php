<div class="table-responsive text-nowrap">

    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($complaints->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif
                </th>
                <th>{{__('admin.date')}}</th>
                <th>{{__('admin.name_to_complain')}}</th>
                <th>{{__('admin.phone_to_complain')}}</th>
                <th>{{__('admin.email_to_complain')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr class="delete_complaint">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$complaint->id}}">
                        </div>
                    </td>
                    <td>{{\Carbon\Carbon::parse($complaint->created_at)->format('d/m/Y')}}</td>
                    <td>{{$complaint->user_name}}</td>
                    <td>{{$complaint->phone}}</td>
                    <td>{{$complaint->email}}</td>
                    <td class="product-action">
                       <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.complaints.show' , ['id' => $complaint->id])}}"><i class="fa fa-eye"></i></a>
                        <span class="delete-row btn rounded-pill btn-danger m-2" data-url="{{url('admin/complaints/'.$complaint->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($complaints->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$complaints"/>

{{-- pagination  links div --}}