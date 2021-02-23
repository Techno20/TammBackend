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
                    <div class="page-header-btns">
                        <a href="" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17.001" viewBox="0 0 17 17.001">
                                <path class="a"
                                      d="M15.885,16.808l-3.344-3.343a7.626,7.626,0,1,1,.924-.924l3.343,3.344a.652.652,0,0,1,0,.923.65.65,0,0,1-.923,0ZM1.308,7.628A6.321,6.321,0,1,0,7.628,1.308,6.328,6.328,0,0,0,1.308,7.628Z" fill="currentcolor" />
                            </svg>
                        </a>
                        <a href="" class="btn notify-spot">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.466" height="20.396" viewBox="0 0 17.466 20.396">
                                <g transform="translate(0)">
                                    <g transform="translate(0 0)">
                                        <path class="a"
                                              d="M5.1,17.411H.957c-.022,0-.044.008-.067.01a.756.756,0,0,1-.825-.667A10.551,10.551,0,0,1,0,15.611V11.363a8.953,8.953,0,0,1,8.009-9.2V.746a.747.747,0,0,1,1.493,0v1.41a8.4,8.4,0,0,1,5.422,2.7,9.476,9.476,0,0,1,2.537,6.507V15.6a10.55,10.55,0,0,1-.059,1.144.753.753,0,0,1-.169.394l-.007.008h0a.744.744,0,0,1-.569.264H12.416a3.732,3.732,0,0,1-7.313,0ZM8.76,18.9a2.24,2.24,0,0,0,2.112-1.492H6.649A2.24,2.24,0,0,0,8.76,18.9Zm7.2-2.984c.007-.107.012-.216.012-.328V11.363A7.959,7.959,0,0,0,13.834,5.87,6.963,6.963,0,0,0,8.76,3.612a7.511,7.511,0,0,0-7.213,7.751v4.557Z" fill="currentcolor" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <a href="" class="btn main-menu-toggle" id="main-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </header>
                <section class="promo-section media align-items-center">
                    <div class="media-body">
                        <h3>@lang('site.improve_your_success_title')</h3>
                        <p>@lang('site.improve_your_success_text').</p>
                        <div class="actions">
                            <a href="" class="btn btn-yallow">@lang('site.read_more')</a>
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
                                        7,345.34 SAR <small>25%</small> <i class="fas fa-chevron-up"></i>
                                    </div>
                                    <div class="content">
                                        <img src="{{ asset('assets/site/images/dashboard/chart.png') }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="balance-box">
                                    <label>@lang('site.total_orders_this_month')</label>
                                    <div class="text red">
                                        7,345.34 SAR <small>25%</small> <i class="fas fa-chevron-down"></i>
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
                                            <th>Service name</th>
                                            <th>Order Date</th>
                                            <th>Due on</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="">create intuitive mobile..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label red">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="">elegant wedding invita..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label red">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="">remove malware recov..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label red">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="">professional logo and..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label red">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="">compelling blog post ..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label red">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="">business card and stat..</a></td>
                                            <td>22 Jun 2020</td>
                                            <td>23 Jun 2020</td>
                                            <td>12.00 SAR</td>
                                            <td><span class="stauts-label">Active</span></td>
                                        </tr>
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