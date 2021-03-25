@extends('site.user.dashboard.layout.main')

@section('css')


@endsection

@section('js')
@endsection

@section('content')
    <section class="main-page-content dashboard-home flex-grow-1">
        <div class="dashboard-home-contnet d-flex">
            <div class="home-contnet">

                <header class="dashboard-header d-flex align-items-center justify-content-between">
                    <div class="title">
                        <h3>@lang('site.dashboard')</h3>
                        <p>
                            @lang('site.welcome'), {{ auth()->user()->name }} @lang('site.welcome_back')
                        </p>
                    </div>

                    @include('site.user.dashboard.includes.notifications')

                </header>
                <section class="promo-section media align-items-center">
                    <div class="media-body">
                        <h3>@lang('site.improve_your_success_title')</h3>
                        <p>@lang('site.improve_your_success_text').</p>
                        <div class="actions">
                            <a href="https://tamm.work/blog" class="btn btn-yallow">@lang('site.read_more')</a>
                        </div>
                    </div>
                    <figure>
                        <img src="{{ asset('assets/site/images/dashboard/freelancer-dashboard.png') }}" class="img-fluid">
                    </figure>
                </section>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="balance-items">
                            <h3 class="m-title">@lang('site.current_balance')</h3>
                            <div class="wrapper">
                                <div class="balance-box">
                                    <label>@lang('site.earings_last_3_month')</label>
                                    <div class="text">
                                        {{ number_format($clientsOrdersPaidCount , 2, '.', '') }} @lang('site.sar')
                                    </div>
                                    <div class="content">
                                        <img src="{{ asset('assets/site/images/dashboard/chart.png') }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="balance-box">
                                    <label>@lang('site.total_orders_this_month')</label>
                                    <div class="text red">
                                        {{ $clientsOrdersCount }}
                                    </div>
                                    <div class="content">
                                        <img src="{{ asset('assets/site/images/dashboard/chart-red.png') }}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="recent-orders-sec">
                            <h3 class="m-title">@lang('site.recent_orders')</h3>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-borderless cs-table-1">
                                        <thead>
                                        <tr>
                                            <th>{{__('site.Service_name')}}</th>
                                            <th>{{__('site.Order_Date')}}</th>
                                            <th>{{__('site.Total')}}</th>
                                            <th>{{__('site.Status')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($clientsOrders as $order)
                                            <tr>
                                                <td><a href="{{ route('user.order.details' , $order->id) }}">{{ $order->Service()->selectCard()->first()->title }}</a>
                                                </td>
                                                <td>{{ date('M d',strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->paid_total }} @lang('site.sar')</td>
                                                <td><span
                                                        class="stauts-label">@lang('default.other.order_status.'.$order->status)</span>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('site.user.dashboard.layout.common.right_side')
        </div>
    </section>
@endsection
