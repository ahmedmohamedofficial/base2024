
<div class="card store card-border-shadow-info">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{-- table content --}}
            <table class="table table-hover" id="tab">
                <thead>
                    <tr>
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
                            <td>{{\Carbon\Carbon::parse($complaint->created_at)->format('d/m/Y')}}</td>
                            <td>{{$complaint->user_name}}</td>
                            <td>{{$complaint->phone}}</td>
                            <td>{{$complaint->email}}</td>
                            <td class="product-action">
                                <a class="btn rounded-pill btn-primary" href="{{route('admin.complaints.show' , ['id' => $complaint->id])}}"><i class="fa fa-eye"></i></a>
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
        @if ($complaints->count() > 0 && $complaints instanceof \Illuminate\Pagination\AbstractPaginator )
            <div class="d-flex justify-content-center mt-3">
                {{$complaints->links()}}
            </div>
        @endif
        {{-- pagination  links div --}}
    </div>
</div>