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
                    <a class="nav-link active" href="{{ url('/') }}">@lang('site.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('service/categories') }}">@lang('site.services')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">@lang('site.how_it_work')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">@lang('site.blog')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">@lang('site.about_us')</a>
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
            <div class="auth-modal signin-modal">
                <header class="auth-header-1 d-flex align-items-center justify-content-between">
                    <h3>Sign in</h3>
                    <a href="#joinTammModal" data-dismiss="modal" data-toggle="modal" class="btn btn-gray">Join now</a>
                </header>
                <div class="social-login">
                    <a href="" class="btn btn-block fb-btn">
                        <i class="fab fa-facebook-square mr-2"></i>
                        Continue with Facebook
                    </a>
                    <a href="" class="btn btn-block google-btn">
                        <img src="{{ asset('assets/site/images/icons/google-ic.svg') }}" class="mr-2">
                        Continue with Google
                    </a>
                    <a href="" class="btn btn-block apple-btn">
                        <i class="fab fa-apple mr-2"></i>
                        Continue with Apple
                    </a>
                </div>

                <p class="or-sec"><span>OR</span></p>

                <div class="auth-form sign-in-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Email/username" name="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="">
                    </div>
                    <div class="form-group">
                        <a href="#resetPasswordModal" data-dismiss="modal" data-toggle="modal" class="forget-password">Forgot your Password?</a>
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow">Continue </button>
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
                    <p>Please enter your email address and we'll send you a link to reset your password.</p>
                </header>


                <div class="auth-form sign-in-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Enter your email" name="">
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow">Continue </button>
                        <p class="text-center back"><a href="#signInModal" data-dismiss="modal" data-toggle="modal" class="">Back to Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- reset-password modal -->
<!-- join-tamm modal -->
<div class="modal fade custom-modal" id="joinTammModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="auth-modal join-tamm-modal">
                <header class="auth-header-1 d-flex align-items-center justify-content-between">
                    <h3>Join Tamm</h3>
                    <a href="#signInModal" data-dismiss="modal" data-toggle="modal" class="btn btn-gray">Sign in</a>
                </header>
                <div class="auth-form join-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Enter your email" name="">
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow">Continue </button>
                    </div>
                </div>
                <p class="or-sec"><span>OR</span></p>
                <div class="social-login">
                    <a href="" class="btn btn-block fb-btn">
                        <i class="fab fa-facebook-square mr-2"></i>
                        Continue with Facebook
                    </a>
                    <a href="" class="btn btn-block google-btn">
                        <img src="{{ asset('assets/site/images/icons/google-ic.svg') }}" class="mr-2">
                        Continue with Google
                    </a>
                    <a href="" class="btn btn-block apple-btn">
                        <i class="fab fa-apple mr-2"></i>
                        Continue with Apple
                    </a>
                </div>




            </div>
        </div>
    </div>
</div>
<!-- join-tamm modal -->
<!-- join-tamm2 modal -->
<div class="modal fade custom-modal" id="joinTamm2Modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="auth-modal join-tamm2-modal">
                <header class="auth-header-1 d-flex align-items-center justify-content-between">
                    <h3>Join Tamm</h3>
                    <a href="#signInModal" data-dismiss="modal" data-toggle="modal" class="btn btn-gray">Sign in</a>
                </header>
                <div class="auth-form join-form gray-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Enter your email" name="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="">
                    </div>
                    <p class="help-text">8 characters or longer. Combine upper and lowercase letters and numbers.</p>

                    <div class="actions">
                        <button type="button" class="btn btn-lg btn-block btn-yallow">Continue </button>
                        <p class="agree-terms">By joining, you agree to Tamm <a href="">Terms of Service</a></p>
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
                        <a class="nav-link active" href="{{ url('/') }}">@lang('site.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('service/categories') }}">@lang('site.services')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">@lang('site.how_it_works')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">@lang('site.blog')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">@lang('site.about_us')</a>
                    </li>
                </ul>
            </div>
            <div class="header-tools">
                <a href="#joinTamm2Modal" class="btn btn-white become-seller" data-toggle="modal">@lang('site.become_seller')</a>
                <a href="#signInModal" class="btn btn-white sign-in" data-toggle="modal">@lang('site.sign_in')</a>
                <a href="#joinTammModal" class="btn btn-yallow join-us" data-toggle="modal">@lang('site.join_us')</a>
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
        </nav>
    </div>
</header>
<!-- End Main Header -->
