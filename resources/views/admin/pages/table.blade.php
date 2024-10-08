<div class="table-responsive text-nowrap">


    {{-- table content --}}
    <table class="table" id="tab">
        <thead>
        <tr>
            <th>{{__('admin.slug')}}</th>
            <th>{{__('admin.title')}}</th>
            <th>{{__('admin.content')}}</th>
            <th>{{__('admin.created_at')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr class="delete_row">
                <td>{{ $page->slug_text }}</td>
                <td>{{ $page->title }}</td>
                <td>{!! Str::limit($page->content, 100) !!}</td>
                <td>{{ $page->created_at_format }}</td>
                <td class="product-action">
                    <a class="btn rounded-pill btn-primary" href="{{ route('admin.pages.edit', ['id' => $page->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($pages->count() == 0)
        <x-admin.empty/>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
<x-admin.footerTable :rows="$pages"/>
