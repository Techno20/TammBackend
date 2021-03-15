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
                    @if($page == 'privacy-policy')
                        <h2>@lang('site.privacy_policy')</h2>
                    @else
                        <h2>@lang('site.terms_of_service')</h2>
                    @endif

{{--                    <p>Lorem Ipsum is simply dummy text of the.</p>--}}
                </header>
                <div class="sec-content">
                    <div class="about-gallery-sec">
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
