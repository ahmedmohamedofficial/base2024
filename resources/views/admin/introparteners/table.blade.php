<div class="table-responsive text-nowrap">
    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($partensers->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif
                </th>
                <th>#</th>
                <th>{{__('admin.image')}}</th>ئ
                <th>{{__('admin.created_at')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partensers as $partenser)
                <tr class="delete_partenser">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$partenser->id}}">
                        </div>
                    </td>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{$partenser->image}}" width="50px" height="50px" alt=""></td>
                    <td>{{$partenser->created_at_format}}</td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary" href="{{route('admin.introparteners.show' , ['id' => $partenser->id])}}"><i class="fa fa-eye"></i></a>
                        <a class="btn rounded-pill btn-primary" href="{{route('admin.introparteners.edit' , ['id' => $partenser->id])}}"><i class="fa fa-edit"></i></a>
                        <span class="btn rounded-pill btn-danger" data-url="{{url('admin/introparteners/'.$partenser->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($partensers->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$partensers"/>

{{-- pagination  links div --}}