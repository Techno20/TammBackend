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

<!-- Main Style CSS -->
@if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/site/css/style-rtl.css') }}" />
    <title>منصة تم</title>
@else
    <link rel="stylesheet" href="{{ asset('assets/site/css/style.css') }}" />
    <title>Tamm</title>
@endif
<link rel="stylesheet" href="{{ asset('assets/site/css/custom.css') }}" />
