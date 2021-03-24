@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">
        <!-- how-its-work-main-section -->
        <section class="how-its-work-main-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="info">
                            <h4 class="wow fadeInUp" data-wow-duration="1.5s">@lang('site.tamm_platform')</h4>
                            <h1 class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">@lang('site.your_dream_it')</h1>
                            <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">@lang('site.work_with_the_best_freelance')</p>
{{--                            <div class="meta d-flex align-items-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">--}}
{{--                                <a href="https://www.youtube.com/watch?v=trcBw4RPmwY" data-fancybox class="icon">--}}
{{--                                    <i class="fas fa-play"></i>--}}
{{--                                </a>--}}
{{--                                @if(isset($how_it_work_video) && !empty($how_it_work_video))--}}
{{--                                <a href="{{ $how_it_work_video }}" data-fancybox class="btn btn-gray">@lang('site.watch_the_video')</a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <figure class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
                            <img src="{{ asset('assets/site/images/how-its-work/main-img.png') }}" class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        <!-- how-its-work-main-section -->

        <section class="text-video-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 ">
                        <figure class="wow fadeInUp" data-wow-duration="1.5s">
                            <img src="{{ asset('assets/site/images/how-its-work/1.png') }}" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-6">
                        <div class="text">
                            <header class="wow fadeInUp" data-wow-duration="1.5s">
                                <h3>{{ $page->name }}</h3>
                            </header>
                            <div class="content">
                                {!! $page->text !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

{{--        @if(isset($pages) && !empty($pages) && $pages->count() > 0)--}}
{{--            @foreach($pages as $key => $value)--}}
{{--                <!-- text-video-section -->--}}
{{--                    <section class="text-video-section">--}}
{{--                        <div class="container">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-lg-6 @if(($key%2) == 1) order-lg-last @endif">--}}
{{--                                    <figure class="wow fadeInUp" data-wow-duration="1.5s">--}}
{{--                                        <img src="{{ asset('assets/site/images/how-its-work/1.png') }}" class="img-fluid">--}}
{{--                                        <a href="" class="video_btn"><i class="fas fa-play"></i></a>--}}
{{--                                    </figure>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="text">--}}
{{--                                        <header class="wow fadeInUp" data-wow-duration="1.5s">--}}
{{--                                            <h3>{{ $value->name }}</h3>--}}
{{--                                        </header>--}}
{{--                                        <div class="content">--}}
{{--                                            {!! $value->text !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </section>--}}
{{--                    <!-- text-video-section -->--}}
{{--            @endforeach--}}
{{--        @endif--}}


    </div>
@endsection
