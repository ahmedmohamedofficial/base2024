<div class="table-responsive text-nowrap">

    {{-- table content --}}
    <table class="table table-hover" id="tab">
        <thead>
            <tr>
                <th>{{ __('admin.provider_name') }}</th>
                <th>{{ __('admin.provider_type') }}</th>
                <th>{{ __('admin.the_amount') }}</th>
                <th>{{ __('admin.settlements_type') }}</th>
                <th>{{ __('admin.settlements_status') }}</th>
                <th>{{ __('admin.order_procedures') }}</th>
                <th>{{ __('admin.created_at') }}</th>
                <th>{{ __('admin.control') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($settlements as $settlement)
                <tr class="delete_row">
                    <td>{{ $settlement->providerable?->name }}</td>
                    <td>{{ $settlement->providerable?->guard_text }}</td>
                    <td>{{ $settlement->amount }}</td>
                    <td>{{ $settlement->type_text }}</td>
                    <td>{{ $settlement->status_text }}</td>

                    <td>
                        @if ($settlement->status == 'pending')
                            <button type="button" class="btn btn-sm btn-success accept-btn" data-bs-toggle="modal"
                                data-bs-target="#acceptModal" data-id="{{ $settlement->id }}"
                                data-amount="{{ $settlement->amount }}" title="{{ __('admin.accept_order') }}">
                                <i class="fa fa-check" style="color: white"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger cancel-btn" data-bs-toggle="modal"
                                data-bs-target="#cancelModal" data-id="{{ $settlement->id }}"
                                title="{{ __('admin.refuse_order') }}">
                                <i class="fa fa-times" style="color: white"></i>
                            </button>
                        @endif
                    </td>
                    <td>{{ $settlement->created_at_format }}</td>
                    <td class="product-action">
                        <a class="btn rounded-pill btn-primary  m-2" href="{{ route('admin.settlements.show', ['id' => $settlement->id]) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($settlements->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($settlements->count() > 0 && $settlements instanceof \Illuminate\Pagination\AbstractPaginator)
    <div class="d-flex justify-content-center mt-3">
        {{ $settlements->links() }}
    </div>
@endif
{{-- pagination  links div --}}
