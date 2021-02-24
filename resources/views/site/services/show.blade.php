@extends('site.layout.main')

@section('css')
@endsection

@section('content')

    <div class="body-content">
        <!-- service-details-tabs-sec -->
        <section class="service-details-tabs-sec">
            <div class="container">
                <div class="wrapper d-flex align-items-center">
                    <div class="links d-flex align-items-center flex-wrap">
                        {{--                        <a href="" class="active">Overview</a>--}}
                        {{--                        <a href="">Description</a>--}}
                        {{--                        <a href="">About The Seller</a>--}}
                        {{--                        <a href="">Compare Packages</a>--}}
                        {{--                        <a href="">Recommendations</a>--}}
                        {{--                        <a href="">FAQ</a>--}}
                        {{--                        <a href="">Review</a>--}}
                    </div>
                    <div class="tools d-flex align-items-center ml-auto">
                        <div class="favorites-count">
                            <i class="fas fa-heart"></i>
                            <span>1,535</span>
                        </div>
                        <div class="share-list dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">facebook</a>
                                <a class="dropdown-item" href="#">twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-details-tabs-sec -->
        <!-- cs-breadcrumb -->
        <nav class="cs-breadcrumb" aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><span>@lang('site.tamm')</span>
                            <i class="fas fa-chevron-right"></i></a></li>
                    @if(isset($result['category']) && !empty($result['category']))
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ url('service/categories/'.$result['category']->main_category_type) }}">
                        <span>
                            @if(app()->getLocale() == 'ar')
                                {{ $result['main_categories'][$result['category']->main_category_type] }}
                            @else
                                {{ ucfirst($result['category']->main_category_type) }}
                            @endif
                        </span><i class="fas fa-chevron-right"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ url('service/list?category_id='.$result['category']->id) }}">
                                <span>{{ $result['category']->name }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>{{ $service->title }}</span>
                        </li>
                    @endif
                </ol>
            </div>
        </nav>
        <!-- cs-breadcrumb -->

        <!-- service-details-section -->
        <section class="service-details-section">
            <div class="container">
                <div class="row">

                    <div class="col-xl-8">
                        <div class="service-details-wrapper">
                            <h1 class="m-title">{{ $service->title }}</h1>
                            <div class="meta d-flex align-items-center">
                                <a href="{{$service->user ? url('user/profile/'.$service->user->id) : ''}}">
                                    <div class="serv-author media align-items-center">
                                        @if(isset($service->user) && !empty($service->user))
                                            @if(file_exists(asset('uploads/users/'.$service->user->avatar)))
                                                <img src="{{ asset('uploads/users/'.$service->user->avatar) }}" class="author-img">
                                            @else
                                                <img src="{{ asset('assets/site/images/user.png') }}" class="author-img">
                                            @endif
                                            <div class="media-body">
                                                <h4>{{ $service->user->name }}</h4>
                                                {{--                                            <p>Creator</p>--}}
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="total-meta d-flex align-item-center">
                                    <p class="total-rate"><i class="fas fa-star"></i> {{ $service->rating_avg }}</p>
                                    <p class="total-reviews">1k+ @lang('site.reviews')</p>
                                </div>
                                <p class="orders-counts">{{ $service->Orders()->count() }} @lang('site.orders_in_queue')</p>
                            </div>
                            @if(isset($service->Gallery) && !empty($service->Gallery) && $service->Gallery->count() > 0)
                                <div class="serv-details-slider-wrapper">
                                    <div class="serv-details-slider-1 owl-carousel">
                                        @foreach($service->Gallery as $key => $value)
                                            @if(isset($value->path) && !empty($value->path) && !empty($value->path) && Storage::exists('services/gallery/'.$value->path))
                                                <div class="item">
                                                    <img src="{{ asset('storage/services/gallery/'.$value->path) }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="slider-2-wrapper">
                                        <div class="serv-details-slider-2 owl-carousel">
                                            @foreach($service->Gallery as $key => $value)
                                                @if(isset($value->path) && !empty($value->path) && !empty($value->path) && Storage::exists('services/thumbs/'.$value->path))
                                                    <div class="item">
                                                        <img src="{{ asset('storage/services/thumbs/'.$value->path) }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="about-serv-sec">
                                <h3 class="title">@lang('site.about_this_service')</h3>
                                <div class="content">
                                    {!!  $service->description  !!}
                                </div>
                            </div>
                            @if($service->user)
                                <div class="serv-seller-box">
                                    <div class="header d-flex align-items-center">
                                        <a href="{{$service->user ? url('user/profile/'.$service->user->id) : ''}}">
                                            <div class="serv-author media align-items-center">
                                                @if(file_exists(asset('uploads/users/'.$service->user->avatar)))
                                                    <img src="{{ asset('uploads/users/'.$service->user->avatar) }}" class="author-img">
                                                @else
                                                    <img src="{{ asset('assets/site/images/user.png') }}" class="author-img">
                                                @endif
                                                <div class="media-body">
                                                    <h4>{{ $service->user->name }}</h4>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="total-meta d-flex align-item-center">
                                            <p class="total-rate"><i class="fas fa-star"></i> {{$service->rating_avg}}</p>
                                        </div>
                                    </div>
                                    <div class="summbary d-flex">
                                        @if($service->user->country)
                                            <div class="info">
                                                <label>@lang('site.from')</label>
                                                <p>{{$service->user->country->name}}</p>
                                            </div>
                                        @endif
                                        <div class="info">
                                            <label>@lang('site.member_since')</label>
                                            <p>{{\Carbon\Carbon::parse($service->user->created_at)->format('Y-m')}}</p>
                                        </div>
                                    </div>
                                    <div class="brief">
                                        {{$service->user->about_me}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <aside class="service-sidebar">
                            <h3 class="title">@lang('site.service_plans')</h3>
                            <div class="plans-tabs">
                                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basic-tab" data-toggle="pill" href="#basic-plan" role="tab">@lang('site.basic')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="standard-tab" data-toggle="pill" href="#standard-plan" role="tab">@lang('site.standard')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="premium-tab" data-toggle="pill" href="#premium-plan" role="tab">@lang('site.premium')</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="basic-plan" role="tabpanel">
                                        <div class="plan-details-wrapper">
                                            <div class="head d-flex align-items-center justify-content-between">
                                                <h4>{{ $service->basic_title }}</h4>
                                                <p class="price">{{ $service->basic_price }} @lang('site.sar')</p>
                                            </div>
                                            <div class="brief">
                                                <p>{{ $service->basic_description }}</p>
                                            </div>
                                            <div class="meta d-flex align-items-center flex-wrap">
                                                <div class="info">
                                                    <i class="far fa-clock"></i>
                                                    <span>{{ $service->basic_delivery_days }} @lang('site.delivery_days')</span>
                                                </div>
                                                {{-- <div class="info">
                                                    <i class="fas fa-sync"></i>
                                                    <span>4 Revisions</span>
                                                </div> --}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->basic_services_list) > 0)
                                                <ul class="serv-features">

                                                    @foreach($service->basic_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            @if($service->user_id != auth()->id())
                                                <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=basic') }}"
                                                   class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->basic_price }} @lang('site.sar'))</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="standard-plan" role="tabpanel">
                                        <div class="plan-details-wrapper">
                                            <div class="head d-flex align-items-center justify-content-between">
                                                <h4>{{ $service->standard_title }}</h4>
                                                <p class="price">{{ $service->standard_price }} @lang('site.sar')</p>
                                            </div>
                                            <div class="brief">
                                                <p>{{ $service->standard_description }}</p>
                                            </div>
                                            <div class="meta d-flex align-items-center flex-wrap">
                                                <div class="info">
                                                    <i class="far fa-clock"></i>
                                                    <span>{{ $service->standard_delivery_days }} @lang('site.delivery_days')</span>
                                                </div>
                                                {{-- <div class="info">
                                                    <i class="fas fa-sync"></i>
                                                    <span>4 Revisions</span>
                                                </div> --}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->standard_services_list) > 0)
                                                <ul class="serv-features">

                                                    @foreach($service->standard_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=standard') }}"
                                               class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->standard_price }} @lang('site.sar'))</a>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="premium-plan" role="tabpanel">
                                        <div class="plan-details-wrapper">
                                            <div class="head d-flex align-items-center justify-content-between">
                                                <h4>{{ $service->premium_title }}</h4>
                                                <p class="price">{{ $service->premium_price }} @lang('site.sar')</p>
                                            </div>
                                            <div class="brief">
                                                <p>{{ $service->premium_description }}</p>
                                            </div>
                                            <div class="meta d-flex align-items-center flex-wrap">
                                                <div class="info">
                                                    <i class="far fa-clock"></i>
                                                    <span>{{ $service->premium_delivery_days }} @lang('site.delivery_days')</span>
                                                </div>
                                                {{-- <div class="info">
                                                    <i class="fas fa-sync"></i>
                                                    <span>4 Revisions</span>
                                                </div> --}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->premium_services_list) > 0)
                                                <ul class="serv-features">

                                                    @foreach($service->premium_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=premium') }}"
                                               class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->premium_price }} @lang('site.sar'))</a>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="serv-question d-flex align-items-center">
                                <img src="{{ asset('assets/site/images/services/serv-question.png') }}" class="img-fluid" alt="">
                                <div class="data">
                                    <h5>@lang('site.any_quastions')?</h5>
                                    <p>@lang('site.if_you_have_any_quastions').</p>
                                </div>
                                <button class="btn btn-yallow" data-toggle="modal" data-target="#sendMessageModal">@lang('site.contact_seller')</button>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-details-section -->

    @if($service->user)
        <!-- services-by-author-section -->
            <section class="services-by-author-section">
                <div class="container">
                    <h2 class="m-title">@lang('site.more_services') <span>{{$service->user->name}}</span></h2>
                    <!-- services -->
                    <div class="row">
                        @foreach($service->user->services()->limit(4)->get() as $item)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="service-item-2">
                                    <div class="top">
                                        <div class="service-item-slider owl-carousel">
                                            @if(isset($item->Gallery) && !empty($item->Gallery) && $item->Gallery->count() > 0 && count($item->Gallery))
                                                @foreach($item->Gallery as $key => $value)
                                                    @if(isset($value->path) && !empty($value->path) && Storage::exists('services/gallery/'.$value->path))
                                                        <div class="item">
                                                            <a href="">
                                                                <img src="{{ asset('storage/services/gallery/'.$value->path) }}">
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="item">
                                                    <a href="">
                                                        <img src="{{ asset('assets/site/images/services/s-2.png') }}">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="" class="add-to-favorites"><i class="fas fa-heart"></i></a>
                                    </div>
                                    <div class="details">
                                        <a href="{{url('user/profile/'.$service->user->id)}}">
                                            <div class="serv-author media">
                                                @if(file_exists(asset('uploads/users/'.$service->user->avatar)))
                                                    <img src="{{ asset('uploads/users/'.$service->user->avatar) }}" class="author-img">
                                                @else
                                                    <img src="{{ asset('assets/site/images/user.png') }}" class="author-img">
                                                @endif
                                                <div class="media-body">
                                                    <h4>{{$service->user->name}}</h4>
                                                </div>
                                            </div>
                                        </a>
                                        <h3 class="title">
                                            <a href="{{ url('service/show/'.$item->id) }}">{{$item->title}}</a>
                                        </h3>
                                        <div class="meta d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                <p>{{ $item->standard_price ?? 0 }} @lang('site.sar')</p>
                                            </div>
                                            <div class="total-meta">
                                                <p class="total-rate"><i class="fas fa-star"></i> {{$item->rating_avg}}</p>
                                                <p class="total-sell">{{ $item->Orders()->count() }} @lang('site.sell')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- services-by-author-section -->
        @endif
    </div>

    <!-- send-message modal -->
    <div class="modal fade custom-modal send-message-modal" id="sendMessageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <header class="head d-flex justify-content-between">
                    <h3>{{__('site.contact_seller')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </header>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details">
                                <div class="user-box">
                                    <div class="user media">
                                        <figure>
                                            <img src="{{ asset('assets/site/images/user.png') }}" alt="">
                                            {{-- <span></span> --}}
                                        </figure>
                                        <div class="media-body">
                                            <h4>{{ $service->user->name }}</h4>
                                            {{-- <p>Online</p> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="times">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="time">
                                                    <label>Local Time</label>
                                                    <p>Mon 18:02</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="time">
                                                    <label>Avg. Rspns</label>
                                                    <p>Mon 18:02</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="includes-box">
                                    <p>{{ __('site.Service_information')}}</p>
                                    <ol class="includes d-flex flex-wrap">
                                        <li>{{__('site.Description_service') }}</li>
                                        <li>{{__('site.Specific_information')}}</li>
                                        <li>{{__('site.Related_files')}}</li>
                                        <li>{{ __('site.budget')}}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="message-wrapper d-flex flex-column ">
                                <textarea name="" class="form-control" placeholder="{{__('site.Write_your_message')}}"></textarea>
                                {{-- <div class="attachments d-flex align-items-center flex-wrap">
                                    <label>المرفقات:</label>
                                    <div class="attachment">
                                        <i class="fas fa-paperclip"></i>
                                        <span>image.png</span>
                                        <a href="">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                    <div class="attachment">
                                        <i class="fas fa-paperclip"></i>
                                        <span>File.docx</span>
                                        <a href="">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="message-controls d-flex align-items-center">
                                    <p class="counter">
                                        <span class="current">87</span>
                                        <span class="total">/ 2500</span>
                                    </p>
                                    <button type="button" class="attachment-btn"><i class="fas fa-paperclip"></i></button>
                                    <button type="button" class="btn btn-yallow">{{__('site.send')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- send-message modal -->

        @endsection



        @section('js')
            <script type="text/javascript">

                $(document).ready(function () {

                    var sync1 = $(".serv-details-slider-1");
                    var sync2 = $(".serv-details-slider-2");
                    var slidesPerPage = 3; //globaly define number of elements per page
                    var syncedSecondary = true;

                    sync1.owlCarousel({
                        items: 1,
                        slideSpeed: 2000,
                        @if(app()->getLocale() == 'ar')
                        rtl: true,
                        @else
                        rtl: false,
                        @endif
                        nav: true,
                        autoplay: false,
                        dots: true,
                        loop: true,
                        responsiveRefreshRate: 200,
                        navText: ["<i class='fas fa-chevron-right' title='Prev'></i>", "<i class='fas fa-chevron-left' title='Next'></i>"]
                    })
                        .on('changed.owl.carousel', syncPosition);

                    sync2
                        .on('initialized.owl.carousel', function () {
                            sync2.find(".owl-item").eq(0).addClass("current");
                        })
                        .owlCarousel({
                            // items : slidesPerPage,
                            dots: false,
                            rtl: true,
                            nav: false,
                            smartSpeed: 200,
                            slideSpeed: 500,
                            //slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                            responsiveRefreshRate: 100,
                            margin: 15,
                            responsive: {
                                // breakpoint from 0 up
                                0: {
                                    items: 2,
                                },
                                // breakpoint from 480 up
                                480: {
                                    items: 3,
                                },
                                // breakpoint from 768 up
                                768: {
                                    items: 4,
                                },
                                // breakpoint from 768 up
                                992: {
                                    items: 5,
                                },
                                // breakpoint from 992 up
                                1200: {
                                    items: 5,
                                    slideBy: 5,
                                }
                            }
                        }).on('changed.owl.carousel', syncPosition2);


                    function syncPosition(el) {
                        //if you set loop to false, you have to restore this next line
                        //var current = el.item.index;

                        //if you disable loop you have to comment this block
                        var count = el.item.count - 1;
                        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                        if (current < 0) {
                            current = count;
                        }
                        if (current > count) {
                            current = 0;
                        }

                        //end block

                        sync2
                            .find(".owl-item")
                            .removeClass("current")
                            .eq(current)
                            .addClass("current");
                        var onscreen = sync2.find('.owl-item.active').length - 1;
                        var start = sync2.find('.owl-item.active').first().index();
                        var end = sync2.find('.owl-item.active').last().index();

                        if (current > end) {
                            sync2.data('owl.carousel').to(current, 100, true);
                        }
                        if (current < start) {
                            sync2.data('owl.carousel').to(current - onscreen, 100, true);
                        }
                    }

                    function syncPosition2(el) {
                        if (syncedSecondary) {
                            var number = el.item.index;
                            sync1.data('owl.carousel').to(number, 100, true);
                        }
                    }

                    sync2.on("click", ".owl-item", function (e) {
                        e.preventDefault();
                        var number = $(this).index();
                        sync1.data('owl.carousel').to(number, 300, true);
                    });
                });
            </script>
@endsection
