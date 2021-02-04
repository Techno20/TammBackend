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
                                <a href="" class="setting">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.315" height="19.374" viewBox="0 0 19.315 19.374">
                                        <g id="settings" transform="translate(-0.342 -0.318)">
                                            <path id="Shape" d="M9.658,19.373h0a2.453,2.453,0,0,1-1.9-.91l-.8-.908a1.127,1.127,0,0,0-.856-.395l-.081,0-1.228.11c-.068.006-.139.009-.208.009a2.487,2.487,0,0,1-1.765-.728,2.524,2.524,0,0,1-.727-1.973l.1-1.263a1.15,1.15,0,0,0-.4-.91l-.908-.791a2.491,2.491,0,0,1,0-3.809l.908-.8a1.128,1.128,0,0,0,.382-.964L2.068,4.819a2.54,2.54,0,0,1,.718-1.974,2.508,2.508,0,0,1,1.769-.736c.066,0,.135,0,.2.008l1.264.1h.051a1.118,1.118,0,0,0,.857-.4l.791-.91A2.5,2.5,0,0,1,9.623,0a2.456,2.456,0,0,1,1.9.91l.8.91a1.144,1.144,0,0,0,.857.387,1.129,1.129,0,0,0,.115-.006l1.229-.108c.079-.008.16-.012.24-.012a2.515,2.515,0,0,1,1.766.732,2.488,2.488,0,0,1,.72,2.007l-.127,1.227a1.147,1.147,0,0,0,.4.908l.908.792a2.491,2.491,0,0,1,0,3.809l-.908.8a1.129,1.129,0,0,0-.382.965l.108,1.227a2.535,2.535,0,0,1-.718,1.973,2.475,2.475,0,0,1-1.768.735c-.066,0-.135,0-.2-.008l-1.264-.1h-.036a1.15,1.15,0,0,0-.873.4l-.791.908a2.486,2.486,0,0,1-1.9.91l-.037.009ZM6.113,15.8h0a2.5,2.5,0,0,1,1.9.91l.8.91a1.126,1.126,0,0,0,.861.4h.061a1.081,1.081,0,0,0,.851-.41l.791-.91a2.488,2.488,0,0,1,1.933-.916c.061,0,.121,0,.177.006l1.227.091a1.153,1.153,0,0,0,.121.007,1.1,1.1,0,0,0,.788-.333,1.139,1.139,0,0,0,.328-.91l-.1-1.218a2.484,2.484,0,0,1,.91-2.11l.908-.8a1.123,1.123,0,0,0,.4-.864,1.089,1.089,0,0,0-.408-.909l-.91-.792a2.5,2.5,0,0,1-.91-2.109l.091-1.227A1.126,1.126,0,0,0,14.809,3.4a1.04,1.04,0,0,0-.105,0l-1.218.1c-.062,0-.126.007-.19.007a2.461,2.461,0,0,1-1.92-.916l-.8-.909a1.13,1.13,0,0,0-.8-.333,1.045,1.045,0,0,0-.119.006H9.6a1.084,1.084,0,0,0-.852.41l-.791.908a2.516,2.516,0,0,1-1.946.915c-.052,0-.106,0-.163-.005L4.622,3.49a1.129,1.129,0,0,0-.12-.007,1.109,1.109,0,0,0-.79.334,1.135,1.135,0,0,0-.328.909l.1,1.219a2.487,2.487,0,0,1-.909,2.109l-.91.8a1.127,1.127,0,0,0-.4.864,1.1,1.1,0,0,0,.41.909l.91.791a2.5,2.5,0,0,1,.908,2.109L3.4,14.755a1.128,1.128,0,0,0,1.124,1.223,1.014,1.014,0,0,0,.1,0l1.218-.1.263-.073Z" transform="translate(0.342 0.318)" fill="currentcolor"/>
                                            <path id="Shape-2" data-name="Shape" d="M3.409,6.818A3.409,3.409,0,1,1,6.818,3.41,3.413,3.413,0,0,1,3.409,6.818Zm0-5.455A2.045,2.045,0,1,0,5.454,3.41,2.048,2.048,0,0,0,3.409,1.364Z" transform="translate(6.591 6.591)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
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
                                    A UX designer with years of building all types of unique experiences <a href=""><i class="fas fa-pen"></i></a>
                                </div>
                                <div class="actions">
                                    <a href="" class="btn btn-outline-darkblue public-mode">View Public Mode</a>
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
                        <div class="user-badge-box">
                            <figure>
                                <img src="{{ asset('assets/site/images/insurance.png') }}" class="img-fluid" alt="">
                            </figure>
                            <h3>Earn badges and stand out</h3>
                            <p>Boost your sales, by boosting your expertise.</p>
                            <div class="actions">
                                <a href="" class="btn btn-yallow btn-lg">Enroll Now</a>
                            </div>
                        </div>
                        <!-- user-badge-box -->

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
                                    <a href="" class="btn add-new-btn">Add new</a>
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
                                    <a href="" class="btn add-new-btn">Add new</a>
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
                                    <h3 class="m-title">Education</h3>
                                    <a href="" class="btn add-new-btn">Add new</a>
                                </header>
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
                                    <a href="#certifications-form" data-toggle="collapse" class="btn add-new-btn">Add new</a>
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
                                <div id="certifications-form" class=" collapse">
                                    <div class="form-wrapper">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg" placeholder="Certificate or award" name="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg" placeholder="Certified from adobe" name="">
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg"     placeholder="Year" name="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="actions d-flex align-items-center">
                                            <a href="" class="btn btn-white cancel">Cancel</a>
                                            <a href="" class="btn btn-yallow ml-2 add">Cancel</a>
                                        </div>
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
                                <h2>Your Services</h2>
                                <div class="status-bar">
                                    <a href="" class="active">ACTIVE GIGS</a>
                                    <a href="">DENIED</a>
                                    <a href="">PAUSED</a>
                                </div>
                            </header>
                            <div class="sec-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="">
                                            <div class="add-new-service-item d-flex flex-column align-items-center justify-content-center">
                                                <figure>
                                                    <img src="{{ asset('assets/site/images/add-new.png') }}" alt="">
                                                </figure>
                                                <h3>Create A New Service</h3>
                                            </div>
                                        </a>
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
