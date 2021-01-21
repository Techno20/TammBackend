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
                        <h2 class="wow fadeInUp" data-wow-duration="1.5s">Get your business done, easily, starting at just <span>50 SAR</span></h2>
                        <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">Work with the best freelance talent from around the world on our secure,flexible and cost-effective platform.</p>
                        <div class="search-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                            <div class="search-form">
                                <input type="text" class="form-control" placeholder="What are you looking for?" name="">
                                <button type="button" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="skills">
                                Try skills like:
                                <span>Desgin</span>
                                <span>Branding</span>
                                <span>Shopify</span>
                                <span>UI/UX Design</span>
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
        <!-- popular-services-section -->
        <section class="popular-services-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>Popular Services</h2>
                </header>
                <div class="sec-content">
                    <div class="services-cat-slider-1 owl-carousel owl-navs-with-header">
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-1.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Illustration</h3>
                                        <p>Draw your imagination</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-2.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Design</h3>
                                        <p>Color your dreams</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-3.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Data Entry</h3>
                                        <p>Learn your business</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-4.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Voice Over</h3>
                                        <p>Color your dreams</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-5.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Branding</h3>
                                        <p>Achiave your dream</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="service-cat-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/services/cat-5.png') }}">
                                    </figure>
                                    <div class="caption">
                                        <h3>Branding</h3>
                                        <p>Achiave your dream</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- popular-services-section -->

        <!-- top-rated-seller-section -->
        <section class="top-rated-seller-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>Top Rated Seller</h2>
                </header>
                <div class="sec-content">
                    <div class="top-rated-seller-slider owl-carousel owl-navs-with-header">
                        <div class="item item-lg">
                            <div class="seller-item-2">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/sellers/item-lg-1.png') }}" class="main-img">
                                    </figure>
                                    <div class="details d-flex align-items-center">
                                        <div class="seller">
                                            <img src="{{ asset('assets/site/images/sellers/u-1.png') }}" class="author-img">
                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        </div>
                                        <div class="content">
                                            <h3>Emilee Simchenko</h3>
                                            <p class="job">UI/UX Designer</p>
                                            <p class="brief">As a UX and Web designer with years of building all types of unique..</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="seller-item-1">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/sellers/item-1.png') }}" class="main-img">
                                    </figure>
                                    <div class="details">
                                        <div class="seller">
                                            <img src="{{ asset('assets/site/images/sellers/u-2.png') }}" class="author-img">
                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        </div>
                                        <div class="content">
                                            <h3>Jenny Murtaugh</h3>
                                            <p class="job">CEO & Mareketing </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="seller-item-1">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/sellers/item-2.png') }}" class="main-img">
                                    </figure>
                                    <div class="details">
                                        <div class="seller">
                                            <img src="{{ asset('assets/site/images/sellers/u-3.png') }}" class="author-img">
                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        </div>
                                        <div class="content">
                                            <h3>Beth Murphy</h3>
                                            <p class="job">Brand Designer</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="seller-item-1">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/sellers/item-3.png') }}" class="main-img">
                                    </figure>
                                    <div class="details">
                                        <div class="seller">
                                            <img src="{{ asset('assets/site/images/sellers/u-4.png') }}" class="author-img">
                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        </div>
                                        <div class="content">
                                            <h3>Marysa Labrone</h3>
                                            <p class="job">DevOps Engineer</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="seller-item-1">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/sellers/item-3.png') }}" class="main-img">
                                    </figure>
                                    <div class="details">
                                        <div class="seller">
                                            <img src="{{ asset('assets/site/images/sellers/u-4.png') }}" class="author-img">
                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        </div>
                                        <div class="content">
                                            <h3>Marysa Labrone</h3>
                                            <p class="job">DevOps Engineer</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- top-rated-seller-section -->

        @if(isset($result['top_selling_services']) && !empty($result['top_selling_services']) && count($result['top_selling_services']) > 0)
        <!-- best-selling-services-section -->
        <section class="best-selling-services-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>Top Selling Services</h2>
                </header>
                <div class="sec-content">
                    <div class="services-slider-1 owl-carousel owl-navs-with-header">
                        @foreach($result['top_selling_services'] as $key => $value)
                        <div class="item">
                                <div class="service-item-1">
                                    <a href="{{ url('service/show/'.$value->id) }}">
                                        <figure>
                                            @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && file_exists(asset('uploads/services/'.$value->image->path)))
                                                <img src="{{ asset('uploads/services/'.$value->image->path) }}" class="main-img">
                                            @else
                                                <img src="{{ asset('assets/site/images/services/s-1.png') }}" class="main-img">
                                            @endif
                                            <div class="caption media">
                                                @if(isset($value->user) && !empty($value->user))
                                                    @if(file_exists(asset('uploads/users/'.$value->user->avatar)))
                                                        <img src="{{ asset('uploads/users/'.$value->user->avatar) }}" class="author-img">
                                                    @else
                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">
                                                    @endif
                                                    <div class="media-body">
                                                        <p>Creator</p>
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
                                <h2>How it’s Work</h2>
                                <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
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

        <!-- marketplaces-section -->
        <section class="marketplaces-section">
            <div class="container wow fadeInUp" data-wow-duration="1.5s">
                <header class="sec-header-1">
                    <h2>Explore The Marketplace</h2>
                </header>
                <div class="sec-content">
                    <div class="marketplace-slider-1 owl-carousel owl-navs-with-header">
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-1.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Graphic Design</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-5.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Video & Animation</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-2.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Digital Marketing</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-6.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Business</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-3.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Writing & Translation</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-7.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Programming & Tech</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-4.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Music & Audio</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-9.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Lifestyle</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-5.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Illustration</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-10.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Book Editing</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-5.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Illustration</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-10.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Book Editing</h3>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-5.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Illustration</h3>
                                </a>
                            </div>
                            <div class="marketplace-item">
                                <a href="">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/marketplaces/p-10.png') }}" class="img-fluid">
                                    </figure>
                                    <h3>Book Editing</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- marketplaces-section -->

        <!-- testimonials-section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="sec-content">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="info">
                                <h2 class="wow fadeInUp" data-wow-duration="1.5s">What Our Customer Are <span>Saying</span></h2>
                                <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">Work with the best freelance talent from around the world on our secure,flexible and cost-effective platform.</p>
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
                                <h2>Find the talent needed to get your business <span>growing</span>.</h2>
                                <a href="" class="btn btn-yallow">Let’s Start</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- call-action-1-section -->
    </div>

@endsection
