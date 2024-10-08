<div class="table-responsive text-nowrap">

    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>
                    @if ($categories->count() > 0)
                        <div class="form-check form-check-danger">
                            <input class="form-check-input p-2" type="checkbox" id="checkedAll">
                        </div>
                    @endif

                </th>
                <th>{{__('admin.image')}}</th>
                <th>{{__('admin.name')}}</th>
                <th>{{ __('admin.view_sub_sections')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr class="delete_row">
                    <td class="text-center">
                        <div class="form-check form-check-danger">
                            <input class="form-check-input checkSingle" type="checkbox" value="" id="{{$category->id}}">
                        </div>
                    </td>
                    <td><img src="{{$category->image}}" width="50px" height="50px" alt=""></td>
                    <td>{{$category->name}}</td>
                    <td><a href="{{route('admin.categories.index' , ['id' => $category->id])}}">{{__('admin.view')}}</a></td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.categories.show' , ['id' => $category->id])}}"><i class="fa fa-eye"></i></a>
                        <a class="btn rounded-pill btn-primary m-2" href="{{route('admin.categories.edit' , ['id' => $category->id])}}"><i class="fa fa-edit"></i></a>
                        <span class="delete-row  btn rounded-pill btn-danger m-2" data-url="{{url('admin/categories/'.$category->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($categories->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$categories"/>

{{-- pagination  links div --}}