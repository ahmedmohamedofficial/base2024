@if (auth('admin')->user()->type == 'super_admin')

    @foreach ($routes_data as $key => $value)

        @if ( $value['icon'] != null && $value['sub_route'] && $value['count'] )

            @include('admin.shared.sidebar.dropdown', compact('value' , 'routes_data'))

        @else

            @include('admin.shared.sidebar.single_side_bar' , compact('value', 'key'))

        @endif

    @endforeach
@else

    @foreach ($routes_data as $key => $value)

        @if ( $value['icon'] != null && $value['sub_route'] && $value['count'] )

            @include('admin.shared.sidebar.dropdown', compact('value' , 'routes_data'))

        @else

            @include('admin.shared.sidebar.single_side_bar' , compact('value'))

        @endisset

    @endforeach
@endif