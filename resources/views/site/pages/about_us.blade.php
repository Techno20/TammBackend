@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">

        <!-- about-us-page -->
        <section class="about-us-page">
            <div class="container">
                <header class="sec-header-2 text-center">
                    <h2>@lang('site.about_us')</h2>
{{--                    <p>Lorem Ipsum is simply dummy text of the.</p>--}}
                </header>
                <div class="sec-content">
                    <div class="about-gallery-sec">
                        <div class="wrapper d-flex flex-wrap">
                            <div class="large-col">
                                <figure class="lg-img wow fadeInUp" data-wow-duration="1.5s">
                                    <img src="{{ asset('assets/site/images/aboutus/1.png') }}" class="img-fluid">
                                </figure>
                            </div>
                            <div class="small-col">
                                <div class="row mx-n1">
                                    <div class="col-12 px-1">
                                        <figure class="sm-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                            <img src="{{ asset('assets/site/images/aboutus/2.png') }}" class="img-fluid">
                                        </figure>
                                    </div>
                                    <div class="col-12 px-1">
                                        <figure class="sm-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                                            <img src="{{ asset('assets/site/images/aboutus/3.png') }}" class="img-fluid">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="large-col">
                                <figure class="lg-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                                    <img src="{{ asset('assets/site/images/aboutus/4.png') }}" class="img-fluid">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="content wow fadeInUp" data-wow-duration="1.5s">
                        @if(isset($page) && !empty($page))
                            {!! $page->text !!}
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- about-us-page -->
    </div>
@endsection
