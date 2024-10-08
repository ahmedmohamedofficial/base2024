@if ($rows->count() > 0 && $rows instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-between mt-3 align-items-center gap-10 flex-wrap" style="padding:30px">
        <div class="pag-right">{{$rows->links()}}</div>
        <div class="pag-left">@lang('admin.show_results_from') {{ $rows->firstItem() }}-{{ $rows->total() }}</div>
    </div>
@endif
