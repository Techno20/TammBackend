<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!--<link rel="shortcut icon" href="{{ asset('assets/site/images/logo.svg') }}" />-->
<link rel="shortcut icon" href="{{ asset('assets/shared/img/favicon.png') }}" />

<!-- Bootstrap CSS -->
@if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap-rtl.min.css') }}" />
@else
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}" />
@endif
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('assets/site/css/animate.css') }}" />
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="{{ asset('assets/site/fontawesome/css/all.css') }}" />
<!-- owl slider CSS -->
<link rel="stylesheet" href="{{ asset('assets/site/plugins/owlslider/assets/owl.carousel.min.css') }}"/>

<link rel="stylesheet" href="{{ asset('assets/site/plugins/fancybox/jquery.fancybox.min.css') }}"/>

<link rel="stylesheet" href="{{ asset('assets/site/plugins/jquery-nice-select-master/css/nice-select.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/site/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}"/>

<!-- Main Style CSS -->
@if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/site/css/style-rtl.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/dashboard-rtl.css') }}" />
    <title>منصة تم</title>
@else
    <link rel="stylesheet" href="{{ asset('assets/site/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/dashboard.css') }}" />
    <title>Tamm</title>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/site/css/custom.css') }}" />
@if(app()->getLocale() == 'ar')
<link rel="stylesheet" href="{{ asset('assets/site/css/custom-rtl.css') }}" />
@endif
