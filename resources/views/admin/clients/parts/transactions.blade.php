
<div class="card store card-border-shadow-success">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{-- table content --}}
            <table class="table table-hover" id="tab">
                <thead>
                    <tr>
                        <th>{{__('admin.date')}}</th>
                        <th>{{__('admin.amount')}}</th>
                        <th>{{__('admin.amount_before')}}</th>
                        <th>{{__('admin.amount_after')}}</th>
                        <th>{{__('admin.type')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="">
                            <td>{{$transaction->createdAtFormat}}</td>
                            <td  class="text-success">{{$transaction->amount }} <span> {{__('apis.currency')}}</span></td>
                            <td  class="text-success">{{$transaction->amount_before }} <span> {{__('apis.currency')}}</span></td>
                            <td  class="text-success">{{$transaction->amount_after }} <span> {{__('apis.currency')}}</span></td>
                            <td>{{$transaction->type_text}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- table content --}}
            {{-- no data found div --}}
            @if ($transactions->count() == 0)
                <x-admin.empty/>
            @endif
            {{-- no data found div --}}
        
        </div>
        {{-- pagination  links div --}}
        @if ($transactions->count() > 0 && $transactions instanceof \Illuminate\Pagination\AbstractPaginator )
            <div class="d-flex justify-content-center mt-3">
                {{$transactions->links()}}
            </div>
        @endif
        {{-- pagination  links div --}}
    </div>
</div>