<li class="menu-item  {{(array_key_exists(substr(Route::currentRouteName(), 6), $value['child']) || in_array(substr(Route::currentRouteName(), 6), $value['child'])) ? 'open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        {!! $value['icon'] !!}

        <div data-i18n="{{__('routes.'. $value['name'])}}">{{__('routes.'. $value['name'])}}</div>
        {{--        <div class="badge bg-primary rounded-pill ms-auto">{{ $value['count'] }}</div>--}}
    </a>
    <ul class="menu-sub">
        @foreach ($value['child'] as $key => $child)
            {{--            @if (isset($routes_data['"admin.' . $key . '"']) && $routes_data['"admin.' . $key . '"']['title'] && $routes_data['"admin.' . $key . '"']['sub_link'])--}}
            @if (isset($child['sub_link']) )
                <li class="menu-item  {{('admin.'.$key) == Route::currentRouteName() ? 'active' : ''}}">
                    <a href="{{route('admin.'.$key)}}" class="menu-link">
                        <div data-i18n="{{ __('routes.admin.'.$key)}}">{{ __('routes.admin.'.$key)}}</div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</li>