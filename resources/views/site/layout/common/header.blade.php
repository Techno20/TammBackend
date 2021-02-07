<!-- pre-loader -->
<section class="pre-loader">
    <div class="loader">
        <div></div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="15" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 30 -10"
                               result="goo"></fecolormatrix>
                <feblend in="SourceGraphic" in2="goo"></feblend>
            </filter>
        </defs>
    </svg>
</section>
<!-- pre-loader -->

<!-- Side Menu -->
<aside class="side-menu">
    <div class="text-right">
        <button class="bg-transparent border-0 btn text-muted btn-lg" id="closeMenu">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="scroll-menu">
        <nav class="scrollspy_menu">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link @if(empty(Request::segment(1)) || Request::segment(1) == '/') active @endif" href="{{ url('/') }}">@lang('site.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), '/service') ? 'active' : '' }}" href="{{ url('service/categories') }}">@lang('site.services')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), '/how-it-work') ? 'active' : '' }}" href="{{ url('how-it-work') }}">@lang('site.how_it_work')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">@lang('site.blog')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), '/about-us') ? 'active' : '' }}" href="{{ url('about-us') }}">@lang('site.about_us')</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="side-overlay"></div>
<!-- Side Menu -->
<!-- sign-in modal -->
<div class="modal fade custom-modal" id="signInModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="auth-modal user_login_block signin-modal">
                <header class="auth-header-1 d-flex align-items-center justify-content-between">
                    <h3>@lang('site.sign_in')</h3>
                    <a href="#joinTamm2Modal" data-dismiss="modal" data-toggle="modal" class="btn btn-gray">@lang('site.join_us')</a>
                </header>

                <div class="auth-form sign-in-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg email" placeholder="@lang('site.email')" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg password" placeholder="@lang('site.password')" name="password">
                    </div>
                    <div class="form-group">
                        <a href="#resetPasswordModal" data-dismiss="modal" data-toggle="modal" class="forget-password">@lang('site.forget_password')</a>
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow user_login">@lang('site.continue') </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sign-in modal -->
<!-- reset-password modal -->
<div class="modal fade custom-modal" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="auth-modal reset-password-modal">
                <header class="auth-header-2 text-center">
                    <h3>Reset Password</h3>
                    <p>Please @lang('site.enter_your') email address and we'll send you a link to reset your password.</p>
                </header>


                <div class="auth-form sign-in-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="@lang('site.enter_your') email" name="">
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow">@lang('site.continue') </button>
                        <p class="text-center back"><a href="#signInModal" data-dismiss="modal" data-toggle="modal" class="">Back to @lang('site.sign_in')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- reset-password modal -->

<!-- join-tamm2 modal -->
<div class="modal fade custom-modal" id="joinTamm2Modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="auth-modal user_register_block join-tamm2-modal">
                <header class="auth-header-1 d-flex align-items-center justify-content-between">
                    <h3>@lang('site.join_us')</h3>
                    <a href="#signInModal" data-dismiss="modal" data-toggle="modal" class="btn btn-gray">@lang('site.sign_in')</a>
                </header>
                <div class="auth-form join-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg name" placeholder="@lang('site.enter_your') @lang('site.name')" name="name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg email" placeholder="@lang('site.enter_your') @lang('site.email')" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg password" placeholder="@lang('site.password')" name="password">
                    </div>
                    <p class="help-text">@lang('site.password_cond')</p>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow user_register">@lang('site.continue') </button>
{{--                        <p class="agree-terms">By joining, you agree to Tamm <a href="">Terms of Service</a></p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- join-tamm2 modal -->

<!-- Start Main Header -->
<header class="main-header @if(empty(Request::segment(1)) || Request::segment(1) == 'home') home-header @endif" id="home">
    <div class="container position-relative">
        <nav class="navbar navbar-expand-lg">
            <a href="{{ url('/') }}" class="brand">
            
                @if(app()->getLocale() == 'ar')
                 <img src="{{ asset('assets/shared/img/logo.svg') }}">
                @else
                    <img src="{{ asset('assets/site/images/logo.svg') }}">
                @endif
            </a>
            <button type="button" class="navbar-toggler btn " id="openMenu">
                <i class="fa fa-align-right fa-fw"></i>
            </button>
            <div class="collapse navbar-collapse " id="main_menu">
                <ul class="navbar-nav main-menu">
                    <li class="nav-item">
                        <a class="nav-link @if(empty(Request::segment(1)) || Request::segment(1) == '/') active @endif" href="{{ url('/') }}">@lang('site.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), '/service') ? 'active' : '' }}" href="{{ url('service/categories') }}">@lang('site.services')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), '/how-it-work') ? 'active' : '' }}" href="{{ url('how-it-work') }}">@lang('site.how_it_works')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">@lang('site.blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), '/about-us') ? 'active' : '' }}" href="{{ url('about-us') }}">@lang('site.about_us')</a>
                    </li>
                </ul>
            </div>

            @if(auth()->guard('web')->check())
            <div class="auth-header-tools">
                <a href="" class="btn btn-gray switch-account"><span>@lang('site.welcome')</span>:{{ auth()->guard('web')->user()->name }}</a>
                <a href="" class="btn btn-gray notification-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.585" height="15.863" viewBox="0 0 13.585 15.863">
                        <g id="bell" transform="translate(0)">
                            <path id="Combined_Shape" data-name="Combined Shape" d="M3.97,13.542H.742l-.05.007a.587.587,0,0,1-.642-.518A8.151,8.151,0,0,1,0,12.142v-3.3a6.964,6.964,0,0,1,6.23-7.152V.581a.58.58,0,1,1,1.16,0v1.1a6.539,6.539,0,0,1,4.217,2.1,7.374,7.374,0,0,1,1.974,5.061v3.3a8.179,8.179,0,0,1-.047.89.586.586,0,0,1-.139.315.579.579,0,0,1-.442.2h-3.3a2.9,2.9,0,0,1-5.688,0ZM6.813,14.7a1.742,1.742,0,0,0,1.642-1.161H5.172A1.742,1.742,0,0,0,6.813,14.7Zm5.6-2.322c.005-.083.009-.168.009-.256V8.837A6.193,6.193,0,0,0,10.76,4.566,5.418,5.418,0,0,0,6.813,2.809,5.843,5.843,0,0,0,1.2,8.837v3.544Z" fill="currentcolor"/>
                        </g>
                    </svg>
                </a>
                <div class="user-quick-menu d-inline-block">
                    <a href="" class="user">
                        <img src="{{ asset('assets/site/images/services/u-2.png') }}" alt="">
                        <span></span>
                    </a>
                    <div class="h-user-quick-menu-dropdown">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <a href="{{ url('user/me') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/user.svg') }}" alt="">
                                    </figure>
                                    <h5>Profile</h5>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ url('user/conversation/list') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/chat-code.svg') }}" alt="">
                                    </figure>
                                    <h5>@lang('site.conversation')</h5>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ url('user/order/list/seller') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/boxes.svg') }}" alt="">
                                    </figure>
                                    <h5>@lang('site.orders')</h5>
                                </a>
                            </div>
{{--                            <div class="col-4">--}}
{{--                                <a href="" class="item">--}}
{{--                                    <figure>--}}
{{--                                        <img src="{{ asset('assets/site/images/icons/heart.svg') }}" alt="">--}}
{{--                                    </figure>--}}
{{--                                    <h5>Likes</h5>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                            <div class="col-4">
                                <a href="{{ url('user/dashboard') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/dashboard.svg') }}" alt="">
                                    </figure>
                                    <h5>@lang('site.dashboard')</h5>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ url('user/me') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/settings.svg') }}" alt="">
                                    </figure>
                                    <h5>@lang('site.settings')</h5>
                                </a>
                            </div>
                            <div class="col-4">
                                @if(app()->getLocale() == 'ar')
                                    <a href="{{ url('lang/en') }}" class="item">
                                        <figure>
                                            <img src="{{ asset('assets/site/images/icons/translator.svg') }}" alt="">
                                        </figure>
                                        <h5>English</h5>
                                    </a>
                                @else
                                    <a href="{{ url('lang/ar') }}" class="item">
                                        <figure>
                                            <img src="{{ asset('assets/site/images/icons/translator.svg') }}" alt="">
                                        </figure>
                                        <h5>Arabic</h5>
                                    </a>
                                @endif
                            </div>
                            <div class="col-4">
                                <a href="{{ url('user/logout') }}" class="item">
                                    <figure>
                                        <img src="{{ asset('assets/site/images/icons/signout.svg') }}" alt="">
                                    </figure>
                                    <h5>@lang('site.logout')</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="btn btn-gray search-btn">
                    <i class="fa fa-search fa-fw"></i>
                </a>
            </div>
            @else
            <div class="header-tools">
                    <a href="#joinTamm2Modal" class="btn btn-white become-seller" data-toggle="modal">@lang('site.become_seller')</a>
                    <a href="#signInModal" class="btn btn-white sign-in" data-toggle="modal">@lang('site.sign_in')</a>
                    <a href="#joinTamm2Modal" class="btn btn-yallow join-us" data-toggle="modal">@lang('site.join_us')</a>
                <div class="dropdown lang-dropdown">
                    <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" >
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        <i class="fas fa-angle-down mr-1"></i>
                    </a>

                    <div class="dropdown-menu">
                        @if(app()->getLocale() == 'ar')
                            <a class="dropdown-item" href="{{ url('lang/en') }}">EN</a>
                        @else
                            <a class="dropdown-item" href="{{ url('lang/ar') }}">AR</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            
        </nav>
    </div>
</header>
<!-- End Main Header -->
