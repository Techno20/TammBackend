<!-- main-footer -->
<footer class="main-footer">
    <div class="f-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">@lang('site.categories')</h3>
                        <ul class="footer-ul-two-col">
                            @foreach(\Helper::getCategories() as $key => $value)
                                <li><a href="{{ url('service/list?category_id='.$value->id) }}">{{ $value->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">@lang('site.more')</h3>
                        <ul>
                            @foreach(\Helper::getMainCategoriesType(false,app()->getLocale()) as $key => $value)
                                <li><a href="{{ url('service/categories/'.$key) }}">{{ $value }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{--<div class="col-lg-1-5 col-md-4 col-6">--}}
                    {{--<div class="f-widget">--}}
                        {{--<h3 class="w-title">@lang('site.support')</h3>--}}
                        {{--<ul>--}}
                            {{--<li><a href="">@lang('site.help_support')</a></li>--}}
                            {{--<li><a href="">@lang('site.trust_safety')</a></li>--}}
                            {{--<li><a href="">@lang('site.selling_on_tamm')</a></li>--}}
                            {{--<li><a href="">@lang('site.buying_on_tamm')</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">@lang('site.tamm')</h3>
                        <ul>
                            <li><a href="{{ url('service/categories') }}">@lang('site.services')</a></li>
                            <li><a href="{{ url('how-it-work') }}">@lang('site.how_it_works')</a></li>
                            <li><a href="https://tamm.work/blog">@lang('site.blog')</a></li>
                            <li><a href="{{ url('about-us') }}">@lang('site.about_us')</a></li>
                            <li><a href="{{ url('contactus') }}">@lang('site.contactus')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-6">
                    <div class="f-widget">
                        <h3 class="w-title">@lang('site.Policies and terms')</h3>
                        <ul>
                            {{--                            <li><a href="">@lang('site.careers')</a></li>--}}
                            {{--<li><a href="">@lang('site.news')</a></li>--}}
                            <li><a href="#">@lang('site.privacy_policy')</a></li>
                            <li><a href="#">@lang('site.terms_of_service')</a></li>
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
