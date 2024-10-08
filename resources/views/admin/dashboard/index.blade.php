@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('/') }}dashboard/assets/vendor/libs/apex-charts/apex-charts.css">

@endsection
@section('content')

    <div class="row">

        <!-- date -->
        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
            <div class="card bg-analytics text-white">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl bg-primary shadow mt-0">
                            <div class="avatar-content">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-2">{{ \Carbon\Carbon::now()->translatedFormat('l j F Y') }}</h1>
                            <p class="m-auto w-75" style=" color: black">{{ $dataHijri }}</p>
                            <hr>
                            <p class="m-0 dashboard-clock-now text-center" style="font-size: 20px; color: black"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- owners and ranters -->
        <div class="col-lg-4 col-md-4 col-12">
            <a href="{{ route('admin.clients.index') }}">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-users text-warning font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1 mb-25">{{ $userCount }}</h2>
                        <p class="mb-0">{{ __("routes.admin.clients.index") }}</p>
                    </div>
                    <div class="card-content">
                        <div id="subscribe-users-chart"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <h3 class="col-12 text-center mb-3">{{__('admin.app_statistics')}}</h3>
        @foreach($menus as $key => $menu)
            @php $color = $colores[array_rand($colores)] @endphp

            <div class="col-lg-3 col-sm-6 mb-4 text-center">
                <a href="{{$menu['url']}}">
                    <div class="card card-border-shadow-{!! $color !!} h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-{!! $color !!}"><i class="{!! $menu['icon'] !!}"></i></span>
                                </div>
                                <h4 class="ms-1 mb-0">{{$menu['count']}}</h4>
                            </div>
                            <p class="mb-1">{{$menu['name']}}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row">
        <h3 class="col-12 text-center mb-3">{{__('admin.introSiteStatistics')}}</h3>
        @foreach($menu2 as $key => $menu)
            @php $color = $colores[array_rand($colores)] @endphp

            <div class="col-lg-3 col-sm-6 mb-4 text-center">
                <a href="{{$menu['url']}}">
                    <div class="card card-border-shadow-{!! $color !!} h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-{!! $color !!}"><i class="{!! $menu['icon'] !!}"></i></span>
                                </div>
                                <h4 class="ms-1 mb-0">{{$menu['count']}}</h4>
                            </div>
                            <p class="mb-1">{{$menu['name']}}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row hight-card">

        <div class="col-lg-6 col-12 p-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4 class="card-title" style="margin-bottom: 20px">{{__('admin.users_active_no_active')}}</h4>
                    <br>
                </div>
                <div class="card-content">
                    <div class="card-body py-0">
                        <div id="users-chart"></div>
                    </div>
                    <ul class="list-group list-group-flush customer-info">
                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-primary"></i>
                                <span class="text-bold-600">{{__('admin.active_users')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$activeUsers}}</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-warning"></i>
                                <span class="text-bold-600">{{__('admin.Not_active_users')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$notActiveUsers}}</span>
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-success"></i>
                                <span class="text-bold-600">{{__('admin.all')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$activeUsers + $notActiveUsers}}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 p-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4 class="card-title" style="margin-bottom: 20px">{{__('admin.users_blocked_no_blocked')}}</h4>
                    <br>
                </div>
                <div class="card-content">
                    <div class="card-body py-0">
                        <div id="users-blocked-chart"></div>
                    </div>
                    <ul class="list-group list-group-flush customer-info">
                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-primary"></i>
                                <span class="text-bold-600">{{__('admin.not_blocked_users')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$nonBlockedUsers}}</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-warning"></i>
                                <span class="text-bold-600">{{__('admin.blocked_users')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$blockedUsers}}</span>
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between ">
                            <div class="series-info">
                                <i class="fa fa-circle font-small-3 text-success"></i>
                                <span class="text-bold-600">{{__('admin.all')}}</span>
                            </div>
                            <div class="product-result">
                                <span>{{$blockedUsers + $nonBlockedUsers}}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>



@endsection
@section('js')

    <script src="{{ asset('/') }}dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{asset('admin/charts_functions.js')}}"></script>
    <script !src="">
        function timeJS() {
            const d             = new Date();
            const local         = d.getTime();
            const offset        = d.getTimezoneOffset() * (60 * 1000);
            const utc           = new Date(local + offset);
            const date          = new Date(utc.getTime() + (3 * 60 * 60 * 1000));
            const options = {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true,
            };
            const time = date.toLocaleTimeString('{{ lang() == 'ar' ? 'ar-SA' : 'en-US' }}', options);
            // console.log(time)
            $('.dashboard-clock-now').text(time);
        }

        timeJS();
        setInterval(function () {
            timeJS()
        }, 1000);


        new ApexCharts(
            document.querySelector("#subscribe-users-chart")
            , radialBarFunction4([{
                name: '{{ __('admin.subscribes') }}',
                data: @json($usersMonths)
            }], ['#FF9F43'])
        ).render();
        new ApexCharts(
            document.querySelector("#users-chart"),
            pieChartFunction(['{{ __('admin.Active_users') }}', '{{ __('admin.Not_active_users') }}'] , [ Number('{{$activeUsers}}'), Number('{{$notActiveUsers}}')] , ['#7367F0', '#FF9F43'])
        ).render();

        new ApexCharts(
            document.querySelector("#users-blocked-chart"),
            pieChartFunction(['{{ __('admin.not_blocked_users') }}', '{{ __('admin.blocked_users') }}'] , [ Number('{{$nonBlockedUsers}}'), Number('{{$blockedUsers}}')] , ['#7367F0', '#FF9F43'])
        ).render();

    </script>

@endsection