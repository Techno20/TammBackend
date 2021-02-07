<!-- main-footer -->
<footer class="main-footer">
    <div class="f-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">@lang('site.categories')</h3>
                        <ul>
                            <li><a href="">Graphics & Design</a></li>
                            <li><a href="">Digital Marketing</a></li>
                            <li><a href="">Writing & Translation</a></li>
                            <li><a href="">Video & Animation</a></li>
                            <li><a href="">Music & Audio</a></li>
                            <li><a href="">Programming & Tech</a></li>
                            <li><a href="">Business</a></li>
                            <li><a href="">Lifestyle</a></li>
                            <li><a href="">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">About</h3>
                        <ul>
                            <li><a href="">Careers</a></li>
                            <li><a href="">Press & News</a></li>
                            <li><a href="">Partnerships</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Terms of Service</a></li>
                            <li><a href="">Intellectual Property</a></li>
                            <li><a href="">Investor Relations</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">Support</h3>
                        <ul>
                            <li><a href="">Help & Support</a></li>
                            <li><a href="">Trust & Safety</a></li>
                            <li><a href="">Selling on Tamm</a></li>
                            <li><a href="">Buying on Tamm</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">Community</h3>
                        <ul>
                            <li><a href="">Events</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Forum</a></li>
                            <li><a href="">Community Standards</a></li>
                            <li><a href="">Podcast</a></li>
                            <li><a href="">Affiliates</a></li>
                            <li><a href="">Invite a Friend</a></li>
                            <li><a href="">Become a Seller</a></li>
                            <li><a href="">Fiverr Elevate</a></li>
                            <li><a href="">Exclusive Benefits</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">More</h3>
                        <ul>
                            <li><a href="">Help & Support</a></li>
                            <li><a href="">Trust & Safety</a></li>
                            <li><a href="">Selling on Tamm</a></li>
                            <li><a href="">Buying on Tamm</a></li>
                            <li><a href="">Tamm Academy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="f-bottom ">
        <div class="container">
            <div class="wrapper d-flex align-items-center justify-content-between">
                <div class="content d-flex align-items-center">
                    <a href="" class="f-logo">
                        @if(app()->getLocale() == 'ar')
                            <img src="{{ asset('assets/shared/img/logo.svg') }}" alt="logo">
                        @else
                            <img src="{{ asset('assets/site/images/f-logo.png') }}" alt="logo">
                        @endif
                    </a>
                    <div class="copyright">© @lang('site.copyright'). {{ date('Y',time()) }}</div>
                </div>
                <div class="f-social">
                    <a href="" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="" target="_blank"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ./main-footer -->
