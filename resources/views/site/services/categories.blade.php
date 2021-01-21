@extends('site.layout.main')

@section('css')
@endsection

@section('content')
    <div class="body-content">
        <!-- main-categories-slider-section -->
        @if(isset($result['main_categories']) && !empty($result['main_categories']) && count($result['main_categories']) > 0)
        <section class="main-categories-slider-section">
            <div class="container">
                <div class="wrapper">
                    <div class="main-categories-slider owl-carousel">
                        @foreach($result['main_categories'] as $key => $value)
                            <a href="{{ url('service/categories/'.$key) }}" class="item ">
                                @if(app()->getLocale() == 'ar')
                                    {{ $value }}
                                @else
                                    {{ ucfirst($key) }}
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- main-categories-slider-section -->

        <!-- services-categories-archive-section -->
        <section class="services-categories-archive-section">
            <div class="container">
                <header class="sec-header-2 text-center">
                    @if(isset($result['main_category_type']) && !empty($result['main_category_type']))
                        @if(app()->getLocale() == 'ar')
                            <h2>{{ $result['main_categories'][$result['main_category_type']] }}</h2>
                        @else
                            <h2>{{ ucfirst($result['main_category_type']) }}</h2>
                        @endif
                    @else
                        @if(app()->getLocale() == 'ar')
                            <h2>{{ $result['main_categories']['all'] }}</h2>
                        @else
                            <h2>All</h2>
                        @endif
                    @endif
{{--                    <p>A single place, millions of creative talents</p>--}}
                </header>
                <div class="sec-content">
                    <div class="row">
                        @if(isset($result['categories']) && !empty($result['categories']) && count($result['categories']->toArray()) > 0)
                            @foreach($result['categories'] as $key => $value)
                            <div class="col-xl-1-5 col-lg-3 col-md-4 col-6">
                            <div class="serv-main-cat-item wow fadeInUp" data-wow-duration="1.5s">
                                <a href="{{ url('service/list?category_id='.$value->id) }}">
                                    <figure>
                                        @if(isset($value->image) && !empty($value->image) &&file_exists(asset('uploads/categories/'.$value->image)))
                                            <img src="{{ asset('uploads/users/'.$value->image) }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('assets/site/images/services/m-cat-1.png') }}" class="img-fluid">
                                        @endif
                                    </figure>
                                    <h3>
                                        <span>{{ $value->name }}</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- services-categories-archive-section -->

    </div>

@endsection



@section('js')

@endsection
