@extends('site.layout.main')

@section('css')
@endsection

@section('content')
    <div class="body-content">
        <!-- cs-breadcrumb -->
        <nav class="cs-breadcrumb" aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><span>@lang('site.tamm')</span>
                            <i class="fas fa-chevron-right"></i>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>@lang('site.search_result'):<b>{{ request()->get('s') }}</b></span>
                    </li>
                </ol>
            </div>
        </nav>
        <!-- cs-breadcrumb -->

        <!-- services-archive-section -->
        <section class="services-archive-section">
            <div class="container">
                <header class="p-header-1">
                    @if(isset($result['category']) && !empty($result['category']))
                    <h1>{{ $result['category']->name }}</h1>
                    @endif
{{--                    <p>Go beyond the logo to establish your brand's identity, colors, and fonts</p>--}}
                </header>
                <div class="sec-content">
                    <!-- p-filter-1 -->
                    {{--<div class="p-filter-1 d-flex align-items-center flex-wrap">--}}
                        {{--<div class="search-input">--}}
                            {{--<input type="text" class="form-control" name="" placeholder="Find Services">--}}
                            {{--<i class="fas fa-search"></i>--}}
                        {{--</div>--}}
                        {{--<div class="cs-dropdown-select dropdown">--}}
                            {{--<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Service Options--}}
                                {{--<i class="fas fa-chevron-down"></i>--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" href="#">Service 1</a>--}}
                                {{--<a class="dropdown-item" href="#">Service 2</a>--}}
                                {{--<a class="dropdown-item" href="#">Service 3</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cs-dropdown-select dropdown">--}}
                            {{--<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Seller Details--}}
                                {{--<i class="fas fa-chevron-down"></i>--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" href="#">Seller 1</a>--}}
                                {{--<a class="dropdown-item" href="#">Seller 2</a>--}}
                                {{--<a class="dropdown-item" href="#">Seller 3</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cs-dropdown-select dropdown">--}}
                            {{--<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Budget--}}
                                {{--<i class="fas fa-chevron-down"></i>--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" href="#">Budget 1</a>--}}
                                {{--<a class="dropdown-item" href="#">Budget 2</a>--}}
                                {{--<a class="dropdown-item" href="#">Budget 3</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cs-dropdown-select dropdown">--}}
                            {{--<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Delivery Time--}}
                                {{--<i class="fas fa-chevron-down"></i>--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" href="#">Delivery Time 1</a>--}}
                                {{--<a class="dropdown-item" href="#">Delivery Time 2</a>--}}
                                {{--<a class="dropdown-item" href="#">Delivery Time 3</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cs-switch ml-auto">--}}
                            {{--<div class="custom-control custom-switch yallow">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="customSwitch1">--}}
                                {{--<label class="custom-control-label" for="customSwitch1">Pro Services</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="cs-switch">--}}
                            {{--<div class="custom-control custom-switch yallow">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="customSwitch2">--}}
                                {{--<label class="custom-control-label" for="customSwitch2">Online Sellers</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    <!-- p-filter-1 -->

                    <!-- services -->
                    <div class="row">
                        @if(isset($services) && !empty($services) && count($services->toArray()) > 0)
                            @foreach($services as $key => $value)
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="service-item-2">
                                        <div class="top">
                                            <div class="service-item-slider owl-carousel">
                                                <div class="item">
                                                    <a href="{{ url('service/show/'.$value->id) }}">
                                                        @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                                            <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                                        @else
                                                            <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
{{--                                            <a href="" class="add-to-favorites"><i class="fas fa-heart"></i></a>--}}
                                        </div>
                                        <div class="details">
                                            <div class="serv-author media">
                                                @if(isset($value->user) && !empty($value->user))
                                                    @if(file_exists(asset('uploads/users/'.$value->user->avatar)))
                                                        <img src="{{ asset('uploads/users/'.$value->user->avatar) }}" class="author-img">
                                                    @else
                                                        <img src="{{ asset('assets/site/images/user.png') }}" class="author-img">
                                                    @endif
                                                    <div class="media-body">
                                                        <h4>{{ $value->user->name }}</h4>
{{--                                                        <p>Creator</p>--}}
                                                    </div>
                                                @endif
                                            </div>
                                            <h3 class="title">
                                                <a href="{{ url('service/show/'.$value->id) }}">{{ $value->title }}</a>
                                            </h3>
                                            <div class="meta d-flex align-items-center justify-content-between">
                                                <div class="price">
                                                    <label>@lang('site.starting')</label>
                                                    <p>{{ $value->basic_price }} @lang('site.sar')</p>
                                                </div>
                                                <div class="total-meta">
                                                    <p class="total-rate"><i class="fas fa-star"></i> {{ $value->rating_avg }}</p>
                                                    <p class="total-sell">{{ $value->Orders()->count() }} @lang('site.sell')</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                        @endif

                    </div>
                    <!-- services -->
                </div>
            </div>
        </section>
        <!-- services-archive-section -->

    </div>
@endsection



@section('js')

@endsection
