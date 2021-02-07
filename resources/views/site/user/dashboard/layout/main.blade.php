<!DOCTYPE html>
@if(App::getLocale() === 'ar')
    <html dir="rtl" lang="ar">
@else
    <html dir="ltr" lang="en">
@endif
    <head>
        @include('site.user.dashboard.layout.common.head')
        @yield('css')
    </head>
    <body>
        <div class="side-overlay"></div>
        <div class="main-dashboard-section d-flex">
            @include('site.user.dashboard.layout.common.left_side')
            @yield('content')
        </div>

        @include('site.user.dashboard.layout.common.script')
        @yield('js')
    </body>
</html>
