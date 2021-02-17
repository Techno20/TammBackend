@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">
        <!-- h-main-section -->
        <section class="h-main-section">
            <div class="container">
                <div class="wrapper d-flex align-items-xl-center align-items-end justify-content-center">
                    <div class="info">
                        <h2 class="wow fadeInUp" data-wow-duration="1.5s">@lang('site.slide_title')</h2>
                        <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">@lang('site.slide_desc')</p>
                        <div class="search-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                            <div class="search-form">
                                <input type="text" class="form-control" placeholder="@lang('site.search_placeholder')" name="">
                                <button type="button" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="skills">
                                @lang('site.try_skills'):
                                @if(isset($result['categories']) && !empty($result['categories']) && count($result['categories']) > 0)
                                    @foreach($result['categories'] as $key => $value)
                                        @if($key < 4)
                                        <span>{{ $value->name }}</span>
                                        @else
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="main-img">
                        <img src="{{ asset('assets/site/images/main-img.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <!-- h-main-section -->

        @if(isset($result['top_rated_services']) && !empty($result['top_rated_services']) && count($result['top_rated_services']) > 0)
        <!-- popular-services-section -->
        <section class="popular-services-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>@lang('site.popular_services')</h2>
                </header>
                <div class="sec-content">
                    <div class="services-cat-slider-1 owl-carousel owl-navs-with-header">
                        @foreach($result['top_rated_services'] as $key => $value)

                        <div class="item">
                            <div class="service-cat-item">
                                <a href="{{ url('service/show/'.$value->id) }}">
                                    <figure>
                                        @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                            <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                        @else
                                            <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                        @endif
                                        {{--@if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && file_exists(asset('uploads/services/'.$value->image->path)))--}}
                                            {{--<img src="{{ asset('uploads/services/'.$value->image->path) }}" class="main-img">--}}
                                        {{--@else--}}
                                            {{--<img src="{{ asset('assets/site/images/services/s-1.png') }}" class="">--}}
                                        {{--@endif--}}
                                    </figure>
                                    <div class="caption">
                                        <h3>{{ $value->title }}</h3>
                                        <p>{{ \Str::limit($value->description , 70)}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- popular-services-section -->
        @endif

        @if(isset($result['top_rated_seller']) && !empty($result['top_rated_seller']) && count($result['top_rated_seller']) > 0)
        <!-- top-rated-seller-section -->
        <section class="top-rated-seller-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>@lang('site.top_rated_seller')</h2>
                </header>
                <div class="sec-content">
                    <div class="top-rated-seller-slider owl-carousel owl-navs-with-header">
                        @foreach($result['top_rated_seller'] as $key => $value)
                            @if($key == 0)
                            <div class="item item-lg">
                                <div class="seller-item-2">
                                    <a href="{{ url('service/show/'.$value->id) }}">
                                        <figure>
                                            {{--@if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && file_exists(asset('uploads/services/'.$value->image->path)))--}}
                                                {{--<img src="{{ asset('uploads/services/'.$value->image->path) }}" class="main-img">--}}
                                            {{--@else--}}
                                                {{--<img src="{{ asset('assets/site/images/services/s-1.png') }}" class="main-img">--}}
                                            {{--@endif--}}
                                            @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                                <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                            @else
                                                <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                            @endif
                                        </figure>
                                        <div class="details d-flex align-items-center">
                                            <div class="seller">
                                                <img src="{{ $value->user->avatar_full_path }}" class="author-img">
                                                <p class="total-rate"><i class="fas fa-star"></i> {{ $value->rating_avg }}</p>
                                            </div>
                                            <div class="content">
                                                <h3>{{ $value->user->name }}</h3>
                                                <p class="job">{{ $value->title }}</p>
                                                <p class="brief">{{ \Str::limit($value->description , 70)}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="item">
                                <div class="seller-item-1">
                                    <a href="">
                                        <figure>
                                            {{--@if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && file_exists(asset('uploads/services/'.$value->image->path)))--}}
                                                {{--<img src="{{ asset('uploads/services/'.$value->image->path) }}" class="main-img">--}}
                                            {{--@else--}}
                                                {{--<img src="{{ asset('assets/site/images/services/s-1.png') }}" class="main-img">--}}
                                            {{--@endif--}}
                                            @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                                <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                            @else
                                                <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                            @endif
                                        </figure>
                                        <div class="details">
                                            <div class="seller">
                                                <img src="{{ $value->user->avatar_full_path }}" class="author-img">
                                                <p class="total-rate"><i class="fas fa-star"></i> {{ $value->rating_avg }}</p>
                                            </div>
                                            <div class="content">
                                                <h3>{{ $value->user->name }}</h3>
                                                <p class="job">{{ $value->title }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- top-rated-seller-section -->
        @endif

        @if(isset($result['top_selling_services']) && !empty($result['top_selling_services']) && count($result['top_selling_services']) > 0)
        <!-- best-selling-services-section -->
        <section class="best-selling-services-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>@lang('site.top_selling_services')</h2>
                </header>
                <div class="sec-content">
                    <div class="services-slider-1 owl-carousel owl-navs-with-header">
                        @foreach($result['top_selling_services'] as $key => $value)
                        <div class="item">
                                <div class="service-item-1">
                                    <a href="{{ url('service/show/'.$value->id) }}">
                                        <figure>
                                            {{--@if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && file_exists(asset('uploads/services/'.$value->image->path)))--}}
                                                {{--<img src="{{ asset('uploads/services/'.$value->image->path) }}" class="main-img">--}}
                                            {{--@else--}}
                                                {{--<img src="{{ asset('assets/site/images/services/s-1.png') }}" class="main-img">--}}
                                            {{--@endif--}}
                                            @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                                <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                            @else
                                                <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                            @endif
                                            <div class="caption media">
                                                @if(isset($value->user) && !empty($value->user))
                                                    <img src="{{ $value->user->avatar_full_path }}" class="author-img">
                                                    <div class="media-body">
{{--                                                        <p>Creator</p>--}}
                                                        <h4>{{ $value->user->name }}</h4>
                                                    </div>
                                                @endif
                                            </div>
                                        </figure>
                                        <div class="details">
                                            <h3>{{ $value->title }}</h3>
                                            <div class="meta d-flex align-items-center">
                                                <p class="total-rate"><i class="fas fa-star"></i> {{ $value->rating_avg }}</p>
                                                <p class="total-sell">{{ $value->Orders()->count() }} Sell</p>
                                            </div>
                                            <p class="brief">
                                                {{ \Str::limit($value->description , 70)}}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- best-selling-services-section -->
        @endif

        <!-- how-its-work-section -->
        <section class="how-its-work-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 order-lg-1">
                        <figure class="main-img wow fadeInUp" data-wow-duration="1.5s">
                            <img src="{{ asset('assets/site/images/how-work-img.png') }}" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5">
                        <div class="info">
                            <header class="wow fadeInUp" data-wow-duration="1.5s">
                                <h2>@lang('site.how_it_work')</h2>
                                <p>@lang('site.how_it_work_desc')</p>
                            </header>
                            <div class="steps">
                                <div class="step d-flex wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                    <i class="fas fa-play"></i>
                                    <div class="content">
                                        <h3>Find your business</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="step d-flex wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">
                                    <i class="fas fa-play"></i>
                                    <div class="content">
                                        <h3>Choose the best service</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="step d-flex wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                                    <i class="fas fa-play"></i>
                                    <div class="content">
                                        <h3>Pay safley and got your service</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- how-its-work-section -->

        @if(isset($result['categories']) && !empty($result['categories']) && count($result['categories']) > 0)
        <!-- marketplaces-section -->
        <section class="marketplaces-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>@lang('site.explore_marketplace')</h2>
                </header>
                <div class="sec-content">
                    <div class="marketplace-slider-1 owl-carousel owl-navs-with-header">
                        @foreach($result['categories'] as $key => $value)
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        @if(isset($value->image) && !empty($value->image) &&file_exists(asset('uploads/categories/'.$value->image)))
                                            <img src="{{ asset('uploads/users/'.$value->image) }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('assets/site/images/marketplaces/p-1.png') }}" class="img-fluid">
                                        @endif
                                    </figure>
                                    <h3>{{ $value->name }}</h3>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- marketplaces-section -->
        @endif

        <!-- testimonials-section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="sec-content">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="info">
                                <h2 class="wow fadeInUp" data-wow-duration="1.5s">@lang('site.customer_saying')</h2>
                                <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">@lang('site.customer_saying_desc')</p>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                            <div class="testimonials-slider owl-carousel">
                                <div class="testimonial-item">
                                    <div class="user-sec media">
                                        <img src="{{ asset('assets/site/images/u-1.png') }}">
                                        <div class="media-body">
                                            <h4>Ghassan Hani</h4>
                                            <p>Product Designer @ REF Group</p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        “Great website ✌️ AI Test, 3000 programs, 200 institutions, 5 continents, Free and paid education opportunities, and one common application.”
                                    </div>
                                </div>
                                <div class="testimonial-item">
                                    <div class="user-sec media">
                                        <img src="{{ asset('assets/site/images/u-1.png') }}">
                                        <div class="media-body">
                                            <h4>Ghassan Hani</h4>
                                            <p>Product Designer @ REF Group</p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        “Great website ✌️ AI Test, 3000 programs, 200 institutions, 5 continents, Free and paid education opportunities, and one common application.”
                                    </div>
                                </div>
                                <div class="testimonial-item">
                                    <div class="user-sec media">
                                        <img src="{{ asset('assets/site/images/u-1.png') }}">
                                        <div class="media-body">
                                            <h4>Ghassan Hani</h4>
                                            <p>Product Designer @ REF Group</p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        “Great website ✌️ AI Test, 3000 programs, 200 institutions, 5 continents, Free and paid education opportunities, and one common application.”
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonials-section -->

        <!-- call-action-1-section -->
        <section class="call-action-1-section">
            <div class="container">
                <div class="sec-content">
                    <div class="row align-items-end">
                        <div class="col-lg-5 order-lg-1">
                            <figure class="main-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                <img src="{{ asset('assets/site/images/call-action-1.png') }}" class="img-fluid">
                            </figure>
                        </div>
                        <div class="col-lg-7">
                            <div class="info wow fadeInUp" data-wow-duration="1.5s">
                                <h2>@lang('site.find_talent_needed')</h2>
                                <a href="{{ url('service/categories') }}" class="btn btn-yallow">@lang('site.lets_start')</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- call-action-1-section -->
    </div>

@endsection
