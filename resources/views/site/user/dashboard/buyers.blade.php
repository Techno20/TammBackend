@extends('site.user.dashboard.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <section class="main-page-content flex-grow-1">
        <!-- header -->
        <header class="dashboard-header d-flex align-items-center justify-content-between">
            <div class="title">
                <h3>@lang('site.buyers')</h3>
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


        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between">
                <h3 class="title">@lang('site.buyers')</h3>
            </header>
            <div class="sec-content">
                <div class="table-responsive">
                    @if(isset($buyers) && !empty($buyers) && $buyers->count() > 0)
                    <table class="table table-borderless cs-table-2">
                        <thead>
                            <tr>
                            <th>@lang('site.buyer_name')</th>
                            <th>@lang('site.country')</th>
                            <th>@lang('site.orders_count')</th>
                            <th>@lang('site.amount_spent')</th>
                            <th>@lang('site.last_order')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($buyers as $key => $value)
                                <tr>
                                    <td>
                                        <div class="media circle-img align-items-center">
                                            @if($value->avatar_full_path)
                                                <img src="{{ $value->avatar_full_path }}" class="">
                                            @else
                                                <img src="{{ asset('assets/site/images/user.png') }}" class="">
                                            @endif
                                            <div class="media-body">
                                                <h3>{{ $value->name }}</h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $value->Country ? $value->Country->name : '-' }}</td>
                                    <td>{{ $value->orders_count }}</td>
                                    <td>{{ number_format($value->Orders()->sum('paid_total'), 2) }} @lang('site.sar')</td>
                                    <td>{{ $value->Orders()->latest()->first() ? date('M d',strtotime($value->Orders()->latest()->first()->created_at)) : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $buyers->links() }}
                    @else
                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                    @endif
                </div>
            </div>
        </section>

    </section>
@endsection
