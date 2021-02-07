@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">
        <!-- freelancer-user-profile-page -->
        <section class="freelancer-user-profile-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- freelancer-profile-box -->
                        <div class="freelancer-profile-box">
                            <div class="status-bar d-flex align-items-center">
                                  
                                    <span class="status ml-auto">
                                        <i class="fas fa-circle"></i>
                                        Online
                                    </span>
                            </div>
                            <div class="user">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" alt="">
                                    <p class="rate">
                                        <i class="fas fa-star"></i>
                                        4.7
                                    </p>
                                </figure>
                                <h3>Emilee Simchenko</h3>
                                <div class="brief">
                                    A UX designer with years of building all types of unique experiences
                                </div>
                                <div class="actions">
                                    <a href="" class="btn btn-yallow">Contact me</a>
                                </div>
                            </div>
                            <div class="user-info form-row">
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <label>From</label>
                                        <p>Palestine</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19.999" height="17.578" viewBox="0 0 19.999 17.578">
                                                <g id="calendar" transform="translate(0 -0.039)">
                                                    <path id="Path" d="M.585,9.375H15.9a.587.587,0,0,0,.375-.136c.147-.123,3.5-3.009,3.707-9.239H3.534C3.33,5.655.241,8.313.209,8.34A.587.587,0,0,0,.585,9.375Z" transform="translate(0 4.726)" fill="currentcolor"/>
                                                    <path id="Path-2" data-name="Path" d="M15.859,1.172H12.93V.586a.586.586,0,0,0-1.172,0v.586H8.789V.586a.586.586,0,0,0-1.172,0v.586H4.688V.586a.586.586,0,0,0-1.172,0v.586H.586A.58.58,0,0,0,0,1.758V3.516H16.445V1.758A.58.58,0,0,0,15.859,1.172Z" transform="translate(3.554 0.039)" fill="currentcolor"/>
                                                    <path id="Path-3" data-name="Path" d="M13.472,4.4a1.763,1.763,0,0,1-1.128.409H0V6.568a.586.586,0,0,0,.586.586H15.859a.586.586,0,0,0,.586-.586V0A11.613,11.613,0,0,1,13.472,4.4Z" transform="translate(3.554 10.463)" fill="currentcolor"/>
                                                </g>
                                            </svg>

                                        </div>
                                        <label>Mbr since</label>
                                        <p>Mar 2019</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <label>Rspns time</label>
                                        <p>2 hours</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- freelancer-profile-box -->


                        <!-- user-badge-box -->
                        <div class="user-successfully-completed-box">
                            <h3 class="m-title">Successfully completed</h3>
                            <div class="content">
                                <div class="media align-items-center">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/award.png') }}" class="img-fluid" alt="">
                                    </figure>
                                    <div class="media-body">
                                        <h5>Online Freelancing Essentials: be a succe..</h5>
                                        <p>Jun 2020</p>
                                    </div>
                                </div>
                                <div class="media align-items-center">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/award.png') }}" class="img-fluid" alt="">
                                    </figure>
                                    <div class="media-body">
                                        <h5>Online Freelancing Essentials: be a succe..</h5>
                                        <p>Dec 2021</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user-badge-box -->
                        <!-- freelancer-info-box -->
                        <div class="freelancer-info-box">
                            <div class="description-sec">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Description</h3>
                                </header>
                                <div class="content">As a UX and Web designer with years of building all types of unique experiences, it is my passion to design, innovate, and produce intuitive and helpful products and websites that not only make a difference but yield delight in peoples' every day lives. I work with small businesses to bring their brand into the digital online space not just by representing them on the web but representing them in the right way, to the right audience. I love working with my clients and I can't wait to speak with you! Please message me with any questions.</div>
                            </div>
                            <div class="languages">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Languages</h3>
                                </header>
                                <div class="content d-flex flex-wrap">
                                    <p>English  - <span>Basic</span></p>
                                    <p>Korean (한국어) - <span>Conversational</span></p>
                                </div>
                            </div>
                            <div class="social-accounts">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Linked Accounts</h3>
                                </header>
                                <div class="content ">
                                    <div class="accounts-links d-flex flex-wrap">
                                        <a href="" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="" target="_blank"><i class="fab fa-facebook-square"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="skills">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Skills</h3>
                                </header>
                                <div class="content d-flex flex-wrap">
                                    <span class="item">Marketing</span>
                                    <span class="item">Writing & Translation</span>
                                    <span class="item">Music & Audio</span>
                                    <span class="item">Video & Animation</span>
                                    <span class="item">CEO</span>
                                    <span class="item">Illustration</span>
                                    <span class="item">Marketing</span>
                                    <span class="item">Graphic design</span>
                                    <span class="item">Marketing</span>
                                    <span class="item">Writing & Translation</span>
                                    <span class="item">Music & Audio</span>
                                    <span class="item">Video & Animation</span>
                                    <span class="item">CEO</span>
                                    <span class="item">Illustration</span>
                                    <span class="item">Marketing</span>
                                    <span class="item">Graphic design</span>
                                </div>
                            </div>
                            <div class="education">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Education</h3>                                    </header>
                                <div class="content ">
                                    <div class="item">
                                        <h5>Associate - Graphic Design</h5>
                                        <p>the art institutes, United States, Graduated 2014</p>
                                    </div>
                                </div>
                            </div>
                            <div class="certifications">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">Certifications</h3>
                                </header>
                                <div class="content ">
                                    <div class="item">
                                        <h5>User Experience Design</h5>
                                        <p>The Team W 2019</p>
                                    </div>
                                    <div class="item">
                                        <h5>Advanced User Experience Design</h5>
                                        <p>The Team W 2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- freelancer-info-box -->
                    </div>
                    <div class="col-xl-6 offset-xl-1 col-lg-7">
                        <!-- user-services-section -->
                        <section class="user-services-section">
                            <header class="p-header-2 d-flex align-items-center justify-content-between">
                                <h2>Emilee Services</h2>
                            </header>
                            <div class="sec-content">
                                <div class="row">
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                </div>

                                <div class="user-reviews-sec">
                                    <header class="head d-flex align-items-center">
                                        <div class="rate d-flex align-items-center">
                                            <span class="rate-count">3,774 Reviews</span>
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rate-text">4.8</span>
                                        </div>
                                        <div class="sort d-flex align-items-center ml-auto">
                                            <label>Sort By</label>
                                            <div class="cs-dropdown-select dropdown">
                                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Most Relevant
                                                    <i class="fas fa-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Most Relevant 1</a>
                                                    <a class="dropdown-item" href="#">Most Relevant 2</a>
                                                    <a class="dropdown-item" href="#">Most Relevant 3</a>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <div class="review-list-sec">
                                        <div class="review-box">
                                            <div class="head d-flex">
                                                <div class="review-author media align-items-center">
                                                    <figure>
                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img" alt="">
                                                        <img src="{{ asset('assets/site/images/services/pal-flag.png') }}" class="author-flag" alt="">
                                                    </figure>
                                                    <div class="media-body">
                                                        <h4>Asaka Chimako</h4>
                                                        <p>Palestine</p>
                                                    </div>
                                                </div>
                                                <div class="rate-comp ml-auto">
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <span>4.8</span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.
                                            </div>
                                        </div>
                                        <div class="review-box">
                                            <div class="head d-flex">
                                                <div class="review-author media align-items-center">
                                                    <figure>
                                                        <img src="{{ asset('assets/site/images/services/u-2.png') }}" class="author-img" alt="">
                                                        <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">
                                                    </figure>
                                                    <div class="media-body">
                                                        <h4>Carolien Bloeme</h4>
                                                        <p>England</p>
                                                    </div>
                                                </div>
                                                <div class="rate-comp ml-auto">
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <span>4.8</span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.
                                            </div>
                                        </div>
                                        <div class="review-box">
                                            <div class="head d-flex">
                                                <div class="review-author media align-items-center">
                                                    <figure>
                                                        <img src="{{ asset('assets/site/images/services/u-3.png') }}" class="author-img" alt="">
                                                        <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">
                                                    </figure>
                                                    <div class="media-body">
                                                        <h4>Alicia Puma</h4>
                                                        <p>England</p>
                                                    </div>
                                                </div>
                                                <div class="rate-comp ml-auto">
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <i class="fas fa-star active"></i>
                                                    <span>4.8</span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.
                                            </div>
                                        </div>
                                        <button type="button" class="btn review-see-more btn-block btn-lg">See More</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- user-services-section -->
                    </div>
                </div>
            </div>
        </section>
        <!-- freelancer-user-profile-page -->
    </div>

@endsection
