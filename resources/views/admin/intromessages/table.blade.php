<div class="table-responsive text-nowrap">
    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($messages->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif
                </th>
                <th>#</th>
                <th>{{__('admin.date')}}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{__('admin.phone')}}</th>
                <th>{{ __('admin.email')}}</th>
                <th>{{__('admin.created_at')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr class="delete_message">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$message->id}}">
                        </div>
                    </td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{\Carbon\Carbon::parse($message->created_at)->format('d/m/Y')}}</td>
                    <td>{{$message->name}}</td>
                    <td>{{$message->phone}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->created_at_format}}</td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary" href="{{route('admin.intromessages.show' , ['id' => $message->id])}}"><i class="fa fa-eye"></i></a>
                        <span class="delete-row btn rounded-pill btn-danger" data-url="{{url('admin/intromessages/'.$message->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($messages->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$messages"/>

{{-- pagination  links div --}}