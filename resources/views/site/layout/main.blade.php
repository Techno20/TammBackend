<!DOCTYPE html>
@if(App::getLocale() === 'ar')
    <html dir="rtl" lang="ar">
@else
    <html dir="ltr" lang="en">
@endif
    <head>
        @include('site.layout.common.head')
        @yield('css')
    </head>
    <body>
        @include('site.layout.common.header')
        @yield('content')
        @include('site.layout.common.footer')

        @include('site.layout.common.script')
        @yield('js')
    </body>
</html>
