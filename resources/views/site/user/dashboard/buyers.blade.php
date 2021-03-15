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
            @include('site.user.dashboard.includes.notifications')
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
