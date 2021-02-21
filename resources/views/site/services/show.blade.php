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
{{--                                    <p>ModernMarvel heartily welcomes you to <b>Minimalist Modern Logo Design gig.</b></p>--}}
{{--                                    <p>We are Brand Creators and professional business consultants. Each business has his own story to tell and having high recall value is prime purpose behind getting a LOGO. Thus, We believe in creating simple yet effective masterpiece which blown away your customers mind.</p>--}}
{{--                                    <p>Your idea of getting Modern memorable and attractive logo design is just one step away. So, Lets discuss and choose a best design for your business.</p>--}}
{{--                                    <p><b>Our recommendation BRANDING PACK @ $55 ONLY:</b></p>--}}
{{--                                    <ol>--}}
{{--                                        <li>5 BRANDED logos with minimal designs + vector source files</li>--}}
{{--                                        <li>Attractive Social media covers (FB and Twitter)</li>--}}
{{--                                        <li>Unlimited revision rounds</li>--}}
{{--                                        <li> Exclusive customer support</li>--}}
{{--                                    </ol>--}}
{{--                                    <p><b>Refund & Package selection guidelines:</b></p>--}}
{{--                                    <ol>--}}
{{--                                        <li>If the designs are as per your initial shared brief, refund wont be a 2- possible option. You can ask for revision if i missed out anything.</li>--}}
{{--                                        <li>My samples are from my premium / standard package.</li>--}}
{{--                                        <li>We are closed on Sunday.</li>--}}
{{--                                    </ol>--}}
{{--                                    <p>My key skills:</p>--}}
{{--                                    <p>Minimalist Modern Logo Design | Minimal | Modern | Typography | Line art | Custom logo | Vintage </p>--}}

                                    {!!  $service->description  !!}
                                </div>



{{--                                <div class="meta d-flex">--}}
{{--                                    <div class="data">--}}
{{--                                        <label>Style</label>--}}
{{--                                        <p>Flat/Minimalist</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="data">--}}
{{--                                        <label>File Format</label>--}}
{{--                                        <p>AI, JPG, PDF, PNG, PSD, EPS, SVG</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
{{--                            <div class="serv-seller-box">--}}
{{--                                <div class="header d-flex align-items-center">--}}
{{--                                    <div class="serv-author media align-items-center">--}}
{{--                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4>Cammy Hedling</h4>--}}
{{--                                            <p>Top rated seller</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="total-meta d-flex align-item-center">--}}
{{--                                        <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>--}}
{{--                                        <p class="total-reviews">1k+ reviews</p>--}}
{{--                                    </div>--}}
{{--                                    <button type="button" class="btn btn-yallow contact-seller-btn" data-toggle="modal" data-target="#sendMessageModal">Contact Seller</button>--}}
{{--                                </div>--}}
{{--                                <div class="summbary d-flex">--}}
{{--                                    <div class="info">--}}
{{--                                        <label>From</label>--}}
{{--                                        <p>Palestine</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="info">--}}
{{--                                        <label>Mbr since</label>--}}
{{--                                        <p>Mar 2019</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="info">--}}
{{--                                        <label>Avg. Rspns time</label>--}}
{{--                                        <p>2 hours</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="info">--}}
{{--                                        <label>Last delivery</label>--}}
{{--                                        <p>~ 3 hours</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="brief">--}}
{{--                                    I am a professional artist having rich experience in hand sketched and digital artwork. I have served tons of businesses with smarter business solutions. I am here to get the global exposure and would like to contribute more towards our creative community. Thanks.--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="serv-packages-sec">--}}
{{--                                <h3 class="title">Compare Packages</h3>--}}
{{--                                <div class="wrapper">--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table table-striped table-borderless">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th width="25%">Package</th>--}}
{{--                                                <th width="25%">--}}
{{--                                                    <div class="header">--}}
{{--                                                        <label>15 SAR</label>--}}
{{--                                                        <h5>Basic</h5>--}}
{{--                                                        <p class="pack">ECONOMIC PACK (BASIC DESIGNS)</p>--}}
{{--                                                        <p class="description">2 BASIC logo + JPG & PNG files   </p>--}}
{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                                <th width="25%">--}}
{{--                                                    <div class="header">--}}
{{--                                                        <label>500 SAR</label>--}}
{{--                                                        <h5>Standerd</h5>--}}
{{--                                                        <p class="pack">CREATIVE PACK (UNIQUE DESIGNS)</p>--}}
{{--                                                        <p class="description">3 UNIQUE logo + UNLIMITED REVISIONS + all designs vector source files</p>--}}
{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                                <th width="25%">--}}
{{--                                                    <div class="header">--}}
{{--                                                        <label>600 SAR</label>--}}
{{--                                                        <h5>Premiun</h5>--}}
{{--                                                        <p class="pack">PRO BRANDING PCK (PREMIUM CONCEPT)</p>--}}
{{--                                                        <p class="description">5 PRO logos + SOCIAL MEDIA KIT (fb+twitter) + All source files + VIP customer support</p>--}}
{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <th>Source File</th>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>Logo Transparency</th>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>High Resolution</th>--}}
{{--                                                <td><i class="fas fa-check"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>Social Media Kit    </th>--}}
{{--                                                <td><i class="fas fa-check"></i></td>--}}
{{--                                                <td><i class="fas fa-check"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>Vector File</th>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                                <td><i class="fas fa-check green"></i></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th># of Initial Concepts Included</th>--}}
{{--                                                <td>2</td>--}}
{{--                                                <td>3</td>--}}
{{--                                                <td>5</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>Revisions</th>--}}
{{--                                                <td>4</td>--}}
{{--                                                <td>Unlimited</td>--}}
{{--                                                <td>Unlimited</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th>Delivery Time</th>--}}
{{--                                                <td>--}}
{{--                                                    <ul class="list-unstyled">--}}
{{--                                                        <li>--}}
{{--                                                            <div class="cs-control">--}}
{{--                                                                <div class="custom-control custom-radio yallow">--}}
{{--                                                                    <input type="radio" id="customRadio1" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                    <label class="custom-control-label" for="customRadio1">4 days</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--                                                            <div class="control-with-note">--}}
{{--                                                                <div class="cs-control">--}}
{{--                                                                    <div class="custom-control custom-radio yallow">--}}
{{--                                                                        <input type="radio" id="customRadio2" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                        <label class="custom-control-label" for="customRadio2">1 days</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <span class="note">(+20 SAR)</span>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}


{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <ul class="list-unstyled">--}}
{{--                                                        <li>--}}
{{--                                                            <div class="cs-control">--}}
{{--                                                                <div class="custom-control custom-radio yallow">--}}
{{--                                                                    <input type="radio" id="customRadio1" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                    <label class="custom-control-label" for="customRadio1">4 days</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--                                                            <div class="control-with-note">--}}
{{--                                                                <div class="cs-control">--}}
{{--                                                                    <div class="custom-control custom-radio yallow">--}}
{{--                                                                        <input type="radio" id="customRadio2" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                        <label class="custom-control-label" for="customRadio2">1 days</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <span class="note">(+20 SAR)</span>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <ul class="list-unstyled">--}}
{{--                                                        <li>--}}
{{--                                                            <div class="cs-control">--}}
{{--                                                                <div class="custom-control custom-radio yallow">--}}
{{--                                                                    <input type="radio" id="customRadio1" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                    <label class="custom-control-label" for="customRadio1">4 days</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                        <li>--}}
{{--                                                            <div class="control-with-note">--}}
{{--                                                                <div class="cs-control">--}}
{{--                                                                    <div class="custom-control custom-radio yallow">--}}
{{--                                                                        <input type="radio" id="customRadio2" name="delivaryTimePackage1" class="custom-control-input">--}}
{{--                                                                        <label class="custom-control-label" for="customRadio2">1 days</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <span class="note">(+20 SAR)</span>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                            <tfoot>--}}
{{--                                            <tr>--}}
{{--                                                <td>Total</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="select-package">--}}
{{--                                                        <label>15 SAR</label>--}}
{{--                                                        <button type="button" class="btn btn-yallow btn-block">Select</button>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="select-package">--}}
{{--                                                        <label>15 SAR</label>--}}
{{--                                                        <button type="button" class="btn btn-yallow btn-block">Select</button>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="select-package">--}}
{{--                                                        <label>15 SAR</label>--}}
{{--                                                        <button type="button" class="btn btn-yallow btn-block">Select</button>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tfoot>--}}
{{--                                        </table>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="recommended-serv-sec">--}}
{{--                                <h3 class="m-title">Recommended For You</h3>--}}
{{--                                <div class="silder-wrapper">--}}
{{--                                    <div class="recommended-serv-slider owl-carousel">--}}
{{--                                        <div class="item">--}}
{{--                                            <div class="service-item-2">--}}
{{--                                                <div class="top">--}}
{{--                                                    <figure>--}}
{{--                                                        <a href="">--}}
{{--                                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">--}}
{{--                                                        </a>--}}
{{--                                                    </figure>--}}
{{--                                                    <a href="" class="add-to-favorites active"><i class="fas fa-heart"></i></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="details">--}}
{{--                                                    <div class="serv-author media">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h4>Florieke Krebber</h4>--}}
{{--                                                            <p>Top rated seller</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <h3 class="title">--}}
{{--                                                        <a href="">I will design your modern brand style guideline for your business</a>--}}
{{--                                                    </h3>--}}
{{--                                                    <div class="meta d-flex align-items-center justify-content-between">--}}
{{--                                                        <div class="price">--}}
{{--                                                            <label>STARTING</label>--}}
{{--                                                            <p>550 SAR</p>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="total-meta">--}}
{{--                                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>--}}
{{--                                                            <p class="total-sell">235 Sell</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="item">--}}
{{--                                            <div class="service-item-2">--}}
{{--                                                <div class="top">--}}
{{--                                                    <figure>--}}
{{--                                                        <a href="">--}}
{{--                                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">--}}
{{--                                                        </a>--}}
{{--                                                    </figure>--}}
{{--                                                    <a href="" class="add-to-favorites active"><i class="fas fa-heart"></i></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="details">--}}
{{--                                                    <div class="serv-author media">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h4>Florieke Krebber</h4>--}}
{{--                                                            <p>Top rated seller</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <h3 class="title">--}}
{{--                                                        <a href="">I will design your modern brand style guideline for your business</a>--}}
{{--                                                    </h3>--}}
{{--                                                    <div class="meta d-flex align-items-center justify-content-between">--}}
{{--                                                        <div class="price">--}}
{{--                                                            <label>STARTING</label>--}}
{{--                                                            <p>550 SAR</p>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="total-meta">--}}
{{--                                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>--}}
{{--                                                            <p class="total-sell">235 Sell</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="item">--}}
{{--                                            <div class="service-item-2">--}}
{{--                                                <div class="top">--}}
{{--                                                    <figure>--}}
{{--                                                        <a href="">--}}
{{--                                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">--}}
{{--                                                        </a>--}}
{{--                                                    </figure>--}}
{{--                                                    <a href="" class="add-to-favorites active"><i class="fas fa-heart"></i></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="details">--}}
{{--                                                    <div class="serv-author media">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h4>Florieke Krebber</h4>--}}
{{--                                                            <p>Top rated seller</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <h3 class="title">--}}
{{--                                                        <a href="">I will design your modern brand style guideline for your business</a>--}}
{{--                                                    </h3>--}}
{{--                                                    <div class="meta d-flex align-items-center justify-content-between">--}}
{{--                                                        <div class="price">--}}
{{--                                                            <label>STARTING</label>--}}
{{--                                                            <p>550 SAR</p>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="total-meta">--}}
{{--                                                            <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>--}}
{{--                                                            <p class="total-sell">235 Sell</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="reviews-details-box">--}}
{{--                                <div class="head d-flex align-items-center">--}}
{{--                                    <div class="rate d-flex align-items-center">--}}
{{--                                        <span class="rate-count">3,774 Reviews</span>--}}
{{--                                        <div class="stars">--}}
{{--                                            <i class="fas fa-star"></i>--}}
{{--                                            <i class="fas fa-star"></i>--}}
{{--                                            <i class="fas fa-star"></i>--}}
{{--                                            <i class="fas fa-star"></i>--}}
{{--                                            <i class="fas fa-star"></i>--}}
{{--                                        </div>--}}
{{--                                        <span class="rate-text">4.8</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="sort d-flex align-items-center ml-auto">--}}
{{--                                        <label>Sort By</label>--}}
{{--                                        <div class="cs-dropdown-select dropdown">--}}
{{--                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                Most Relevant--}}
{{--                                                <i class="fas fa-chevron-down"></i>--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                                <a class="dropdown-item" href="#">Most Relevant 1</a>--}}
{{--                                                <a class="dropdown-item" href="#">Most Relevant 2</a>--}}
{{--                                                <a class="dropdown-item" href="#">Most Relevant 3</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-progress d-flex align-items-center">--}}
{{--                                            <label>5 Stars</label>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="text">(3,234)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-progress d-flex align-items-center">--}}
{{--                                            <label>5 Stars</label>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="text">(3,234)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-progress d-flex align-items-center">--}}
{{--                                            <label>5 Stars</label>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="text">(3,234)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-progress d-flex align-items-center">--}}
{{--                                            <label>5 Stars</label>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="text">(3,234)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-progress d-flex align-items-center">--}}
{{--                                            <label>5 Stars</label>--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="text">(3,234)</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="review-switch">--}}
{{--                                            <div class="custom-control custom-switch">--}}
{{--                                                <input type="checkbox" class="custom-control-input" id="customSwitch1">--}}
{{--                                                <label class="custom-control-label" for="customSwitch1">Show only reviews with delivery images (28)</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="review-list-sec">--}}
{{--                                <div class="review-box">--}}
{{--                                    <div class="head d-flex">--}}
{{--                                        <div class="review-author media align-items-center">--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img" alt="">--}}
{{--                                                <img src="{{ asset('assets/site/images/services/pal-flag.png') }}" class="author-flag" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h4>Asaka Chimako</h4>--}}
{{--                                                <p>Palestine</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate-comp ml-auto">--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <span>4.8</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="content">--}}
{{--                                        Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="review-box">--}}
{{--                                    <div class="head d-flex">--}}
{{--                                        <div class="review-author media align-items-center">--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{ asset('assets/site/images/services/u-2.png') }}" class="author-img" alt="">--}}
{{--                                                <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h4>Carolien Bloeme</h4>--}}
{{--                                                <p>England</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate-comp ml-auto">--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <span>4.8</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="content">--}}
{{--                                        Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="review-box">--}}
{{--                                    <div class="head d-flex">--}}
{{--                                        <div class="review-author media align-items-center">--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{ asset('assets/site/images/services/u-3.png') }}" class="author-img" alt="">--}}
{{--                                                <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">--}}
{{--                                            </figure>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h4>Alicia Puma</h4>--}}
{{--                                                <p>England</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate-comp ml-auto">--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <i class="fas fa-star active"></i>--}}
{{--                                            <span>4.8</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="content">--}}
{{--                                        Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button type="button" class="btn review-see-more btn-block btn-lg">See More</button>--}}
{{--                            </div>--}}

{{--                            <div class="serv-tags-sec">--}}
{{--                                <h4>Related Tags</h4>--}}
{{--                                <div class="tags">--}}
{{--                                    <a href="">flat logo</a>--}}
{{--                                    <a href="">minimalist logo</a>--}}
{{--                                    <a href="">Logo Design</a>--}}
{{--                                    <a href="">unique</a>--}}
{{--                                    <a href="">business logo</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <aside class="service-sidebar">
                            <h3 class="title">@lang('site.service_plans')</h3>
                            <div class="plans-tabs">
                                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basic-tab" data-toggle="pill" href="#basic-plan" role="tab" >@lang('site.basic')</a>
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
                                                {{--                                                <div class="info">--}}
                                                {{--                                                    <i class="fas fa-sync"></i>--}}
                                                {{--                                                    <span>4 Revisions</span>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->basic_services_list) > 0)
                                                <ul class="serv-features">
                                                    @foreach($service->basic_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=basic') }}"  class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->basic_price }} @lang('site.sar'))</a>
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
                                                {{--                                                <div class="info">--}}
                                                {{--                                                    <i class="fas fa-sync"></i>--}}
                                                {{--                                                    <span>4 Revisions</span>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->standard_services_list) > 0)
                                                <ul class="serv-features">
                                                    @foreach($service->standard_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=standard') }}"  class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->standard_price }} @lang('site.sar'))</a>
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
                                                {{--                                                <div class="info">--}}
                                                {{--                                                    <i class="fas fa-sync"></i>--}}
                                                {{--                                                    <span>4 Revisions</span>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <?php //$services_list = explode('||',$service->basic_services_list); ?>
                                            @if(count($service->premium_services_list) > 0)
                                                <ul class="serv-features">
                                                    @foreach($service->premium_services_list as $value)
                                                        <li class="active"><i class="fas fa-check"></i> {{ $value }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ url('checkout/order-details?service_id='.$service->id.'&package=premium') }}"  class="btn btn-block btn-yallow serv-continue-btn">@lang('site.continue') ({{ $service->standard_price }} @lang('site.sar'))</a>
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

        <!-- services-by-author-section -->
        <section class="services-by-author-section">
            <div class="container">
                <h2 class="m-title">More Services By <span>ei8htz</span></h2>
                <!-- services -->
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="service-item-2">
                            <div class="top">
                                <div class="service-item-slider owl-carousel">
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-1.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-3.png') }}">
                                        </a>
                                    </div>
                                </div>
                                <a href="" class="add-to-favorites"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="details">
                                <div class="serv-author media">
                                    <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">
                                    <div class="media-body">
                                        <h4>Cammy Hedling</h4>
                                        <p>Top rated seller</p>
                                    </div>
                                </div>
                                <h3 class="title">
                                    <a href="">I will design your modern brand style guideline for your business</a>
                                </h3>
                                <div class="meta d-flex align-items-center justify-content-between">
                                    <div class="price">
                                        <label>STARTING</label>
                                        <p>550 SAR</p>
                                    </div>
                                    <div class="total-meta">
                                        <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        <p class="total-sell">235 Sell</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="service-item-2">
                            <div class="top">
                                <div class="service-item-slider owl-carousel">
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-1.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-3.png') }}">
                                        </a>
                                    </div>
                                </div>
                                <a href="" class="add-to-favorites active"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="details">
                                <div class="serv-author media">
                                    <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">
                                    <div class="media-body">
                                        <h4>Florieke Krebber</h4>
                                        <p>Top rated seller</p>
                                    </div>
                                </div>
                                <h3 class="title">
                                    <a href="">I will design your modern brand style guideline for your business</a>
                                </h3>
                                <div class="meta d-flex align-items-center justify-content-between">
                                    <div class="price">
                                        <label>STARTING</label>
                                        <p>550 SAR</p>
                                    </div>
                                    <div class="total-meta">
                                        <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        <p class="total-sell">235 Sell</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="service-item-2">
                            <div class="top">
                                <div class="service-item-slider owl-carousel">
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-3.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-1.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">
                                        </a>
                                    </div>
                                </div>
                                <a href="" class="add-to-favorites"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="details">
                                <div class="serv-author media">
                                    <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">
                                    <div class="media-body">
                                        <h4>Ekaterina Tankova</h4>
                                        <p>Top rated seller</p>
                                    </div>
                                </div>
                                <h3 class="title">
                                    <a href="">I will design your modern brand style guideline for your business</a>
                                </h3>
                                <div class="meta d-flex align-items-center justify-content-between">
                                    <div class="price">
                                        <label>STARTING</label>
                                        <p>550 SAR</p>
                                    </div>
                                    <div class="total-meta">
                                        <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        <p class="total-sell">235 Sell</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="service-item-2">
                            <div class="top">
                                <div class="service-item-slider owl-carousel">
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-4.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-2.png') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="">
                                            <img src="{{ asset('assets/site/images/services/si-3.png') }}">
                                        </a>
                                    </div>
                                </div>
                                <a href="" class="add-to-favorites active"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="details">
                                <div class="serv-author media">
                                    <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img">
                                    <div class="media-body">
                                        <h4>Leslee Moss</h4>
                                        <p>Top rated seller</p>
                                    </div>
                                </div>
                                <h3 class="title">
                                    <a href="">I will design your modern brand style guideline for your business</a>
                                </h3>
                                <div class="meta d-flex align-items-center justify-content-between">
                                    <div class="price">
                                        <label>STARTING</label>
                                        <p>550 SAR</p>
                                    </div>
                                    <div class="total-meta">
                                        <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                        <p class="total-sell">235 Sell</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- services-by-author-section -->
    </div>

@endsection



@section('js')
    <script type="text/javascript">

        $(document).ready(function() {

            var sync1 = $(".serv-details-slider-1");
            var sync2 = $(".serv-details-slider-2");
            var slidesPerPage = 3; //globaly define number of elements per page
            var syncedSecondary = true;

            sync1.owlCarousel({
                items : 1,
                slideSpeed : 2000,
                @if(app()->getLocale() == 'ar')
                rtl:true,
                @else
                rtl:false,
                @endif
                nav: true,
                autoplay: false,
                dots: true,
                loop: true,
                responsiveRefreshRate : 200,
                navText: ["<i class='fas fa-chevron-right' title='Prev'></i>","<i class='fas fa-chevron-left' title='Next'></i>"]
            })
                .on('changed.owl.carousel', syncPosition);

            sync2
                .on('initialized.owl.carousel', function () {
                    sync2.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                    // items : slidesPerPage,
                    dots: false,
                    rtl:true,
                    nav: false,
                    smartSpeed: 200,
                    slideSpeed : 500,
                    //slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    responsiveRefreshRate : 100,
                    margin:15,
                    responsive : {
                        // breakpoint from 0 up
                        0 : {
                            items:2,
                        },
                        // breakpoint from 480 up
                        480 : {
                            items:3,
                        },
                        // breakpoint from 768 up
                        768 : {
                            items:4,
                        },
                        // breakpoint from 768 up
                        992 : {
                            items:5,
                        },
                        // breakpoint from 992 up
                        1200 : {
                            items:5,
                            slideBy:5,
                        }
                    }
                }).on('changed.owl.carousel', syncPosition2);


            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count-1;
                var current = Math.round(el.item.index - (el.item.count/2) - .5);

                if(current < 0) {
                    current = count;
                }
                if(current > count) {
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
                if(syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        });
    </script>
@endsection
