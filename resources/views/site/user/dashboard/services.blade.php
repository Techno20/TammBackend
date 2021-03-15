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
                <h3>@lang('site.services')</h3>
                <p>
                    @lang('site.welcome'), {{ auth()->user()->name }} @lang('site.welcome_back')
                </p>
            </div>
            @include('site.user.dashboard.includes.notifications')
        </header>

        <!-- filter -->
        <section class="filter-cats-sec">
            <a href="{{ url('user/service/list?main_category_type=technical') }}" class="item @if((request()->has('main_category_type') && request()->main_category_type =='technical') || !request()->has('main_category_type')) active @endif">@lang('default.other.main_category_types.technical') @if((request()->has('main_category_type') && request()->main_category_type =='technical') || !request()->has('main_category_type')) ({{$services->count()}}) @endif</a>
            <a href="{{ url('user/service/list?main_category_type=consultation') }}" class="item @if(request()->has('main_category_type') && request()->main_category_type =='consultation') active @endif">@lang('default.other.main_category_types.consultation') @if(request()->has('main_category_type') && request()->main_category_type =='consultation') ({{$services->count()}}) @endif</a>
            <a href="{{ url('user/service/list?main_category_type=training') }}" class="item @if(request()->has('main_category_type') && request()->main_category_type =='training') active @endif">@lang('default.other.main_category_types.training') @if(request()->has('main_category_type') && request()->main_category_type =='training') ({{$services->count()}}) @endif</a>
            <a href="{{ url('user/service/list?main_category_type=all') }}" class="item @if(request()->has('main_category_type') && request()->main_category_type =='all') active @endif">@lang('site.all') @if(request()->has('main_category_type') && request()->main_category_type =='all') ({{$services->count()}}) @endif</a>
        </section>

        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between">
                <h3 class="title">@lang('site.services')</h3>
                <div class="btns">
                    <a href="{{ url('user/service/add') }}" class="btn btn-yallow">@lang('site.add_new_service')</a>
                </div>
            </header>
            <div class="sec-content">
                <div class="table-responsive">
                    @if(isset($services) && !empty($services) && $services->count() > 0)
                    <table class="table table-borderless cs-table-2">
                        <thead>
                        <tr>
                            <th>@lang('site.service_title')</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.rate')</th>
                            <th>@lang('site.view')</th>
                            <th>@lang('site.edit')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $key => $value)
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                        <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                    @else
                                        <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                    @endif
                                    <div class="media-body">
                                        <h3>{{ $value->title }}</h3>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $value->Category->name }}</td>
                            <td>
                                {{ $value->getAverageServiceRating() }}
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ url('service/show/'.$value->id) }}" class="btn btn-yallow"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ url('user/service/add/'.$value->id) }}" class="btn btn-green"><i class="fa fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{ $services->links() }}
                    @else
                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                    @endif
                </div>
            </div>
        </section>

    </section>
@endsection
