<!DOCTYPE html>
@if(App::getLocale() === 'ar')
    <html dir="rtl" lang="ar">
@else
    <html dir="ltr" lang="en">
@endif
    <head>
        @include('site.layout.common.head')
        @if(app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('assets/site/css/dashboard-rtl.css') }}" />
        @else
            <link rel="stylesheet" href="{{ asset('assets/site/css/dashboard.css') }}" />
        @endif
        @yield('css')
    </head>
    <body>
        <div class="side-overlay"></div>
        <div class="main-dashboard-section d-flex">
            @include('site.user.dashboard.layout.common.left_side')
            @yield('content')
        </div>

        @include('site.layout.common.script')
        @if(app()->getLocale() == 'ar')
            <script src="{{ asset('assets/site/js/dashboard-rtl.js') }}"></script>
        @else
            <script src="{{ asset('assets/site/js/dashboard.js') }}"></script>
        @endif
        @yield('js')
    </body>
</html>
