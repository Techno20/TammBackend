@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style-rtl.css') }}"/>
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style.css') }}"/>
    @endif

    <style>

        .body-content {
            background: #fff;
        }

        .form-wizard .wizard-fieldset {
            display: none;
        }

        .form-wizard .wizard-fieldset.show {
            display: block;
        }

        .form-wizard .wizard-form-error {
            display: none;
            background-color: #ff0000;
            position: relative;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
        }

        .form-wizard .form-control:focus {
            box-shadow: none;
        }

        .form-wizard .form-group {
            position: relative;
        }

        .form-wizard .wizard-form-text-label {
            position: absolute;
            left: 10px;
            top: 16px;
            transition: 0.2s linear all;
        }

        .form-wizard .focus-input .wizard-form-text-label {
            color: #d65470;
            top: -18px;
            transition: 0.2s linear all;
            font-size: 12px;
        }

        .form-wizard .wizard-password-eye {
            position: absolute;
            right: 32px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        @keyframes click-radio-wave {
            0% {
                width: 25px;
                height: 25px;
                opacity: 0.35;
                position: relative;
            }
            100% {
                width: 60px;
                height: 60px;
                margin-left: -15px;
                margin-top: -15px;
                opacity: 0.0;
            }
        }

        @media screen and (max-width: 767px) {
            .wizard-content-left {
                height: auto;
            }
        }

        #requirements {
            visibility: hidden;
        }

    </style>

    <style>
        .form-row {
            width: 70%;
            float: left;
            background-color: #ededed;
        }

        #card-element {
            background-color: transparent;
            height: 40px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        #card-element--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        #card-element--invalid {
            border-color: #fa755a;
        }

        #card-element--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #submitbutton, #tap-btn {
            align-items: flex-start;
            background-attachment: scroll;
            background-clip: border-box;
            background-color: rgb(50, 50, 93);
            background-image: none;
            background-origin: padding-box;
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            border-bottom-color: rgb(255, 255, 255);
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            border-bottom-style: none;
            border-bottom-width: 0px;
            border-image-outset: 0px;
            border-image-repeat: stretch;
            border-image-slice: 100%;
            border-image-source: none;
            border-image-width: 1;
            border-left-color: rgb(255, 255, 255);
            border-left-style: none;
            border-left-width: 0px;
            border-right-color: rgb(255, 255, 255);
            border-right-style: none;
            border-right-width: 0px;
            border-top-color: rgb(255, 255, 255);
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-top-style: none;
            border-top-width: 0px;
            box-shadow: rgba(50, 50, 93, 0.11) 0px 4px 6px 0px, rgba(0, 0, 0, 0.08) 0px 1px 3px 0px;
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            cursor: pointer;
            display: block;
            float: left;
            font-family: "Helvetica Neue", Helvetica, sans-serif;
            font-size: 15px;
            font-stretch: 100%;
            font-style: normal;
            font-variant-caps: normal;
            font-variant-east-asian: normal;
            font-variant-ligatures: normal;
            font-variant-numeric: normal;
            font-weight: 600;
            height: 35px;
            letter-spacing: 0.375px;
            line-height: 35px;
            margin-bottom: 0px;
            margin-left: 12px;
            margin-right: 0px;
            margin-top: 28px;
            outline-color: rgb(255, 255, 255);
            outline-style: none;
            outline-width: 0px;
            overflow-x: visible;
            overflow-y: visible;
            padding-bottom: 0px;
            padding-left: 14px;
            padding-right: 14px;
            padding-top: 0px;
            text-align: center;
            text-decoration-color: rgb(255, 255, 255);
            text-decoration-line: none;
            text-decoration-style: solid;
            text-indent: 0px;
            text-rendering: auto;
            text-shadow: none;
            text-size-adjust: 100%;
            text-transform: none;
            transition-delay: 0s;
            transition-duration: 0.15s;
            transition-property: all;
            transition-timing-function: ease;
            white-space: nowrap;
            width: 150.781px;
            word-spacing: 0px;
            writing-mode: horizontal-tb;
            -webkit-appearance: none;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-border-image: none;

        }
    </style>
    <style>
        #requirements {
            position: absolute;
            top: -100px;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            if ($('select.nice-select-me').length != 0) {
                $('select.nice-select-me').niceSelect();
            }

            if ($('.tags-input').length != 0) {
                $('.tags-input').val();
            }

            $('body').on('click', '.btn-add-new-record', function () {
                $('.extra-container').append($('.extra-template').html());
            });
            $('body').on('click', '.btn-remove-record', function () {
                $(this).parent().parent().html('');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('body').on('change', '.select2', function () {
                console.log($('.select2').val());
            });
            /*
            $('body').on('click','.add_service_overview_button',function () {
            $('body').on('click','.add_service_overview_button',function () {
                var title = $('.add_service_overview_block .title').val();
                var main_category_type = $('.add_service_overview_block .main_category_type').val();
                var category_id = $('.add_service_overview_block .category_id').val();
//                var language = $('.add_service_overview_block .language').val();
                let data = {
                    "_token": "{{ csrf_token() }}",
                    "title": title,
                    "main_category_type": main_category_type,
                    "category_id": category_id,
                    "basic_delivery_days": 1,
                    "standard_delivery_days": 1,
                    "premium_delivery_days": 1,
                }
                $.ajax({
                    type: "POST",
                    url: '{{ url('user/service/add') }}',
                    data: data,
                    dataType: 'json',
                    success:  function(result){
                        Swal.fire({
                            icon: "success",
                            title: "نجاح",
                            text: "تمت عملية التسجيل بنجاح",
                            showConfirmButton : false,
                            confirmButtonText: 'استمرار'
                        });
                        setTimeout(function () {
                            window.location = "{{ url('user/service/pricing?service=') }}";
                        },3000);
                    },
                    error:  function(result){
                        if (result.responseJSON.status == false && result.responseJSON.message == 'login_failed'){
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                html: result.responseJSON.message_string,
                                confirmButtonText: 'موافق'
                            })
                        }else if(result.responseJSON && result.responseJSON.data && result.responseJSON.data.hasOwnProperty('errors')){
                            var errors_text = '';
                            $.each(result.responseJSON.data.errors, function(i, item) {
                                errors_text = errors_text+item+'<br/>';
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                // text: errors_text,
                                html: errors_text,
                                confirmButtonText: 'موافق'
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                html: 'الرجاء التأكد من البيانات المدخلة',
                                confirmButtonText: 'موافق'
                            })
                        }

                    }
                });
            });
            */
        });

        jQuery(document).ready(function () {
            // click on next button
            jQuery('.form-wizard-next-btn').click(function () {
                var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps li .active');
                var next = jQuery(this);
                var nextWizardStep = true;
                parentFieldset.find('.wizard-required').each(function () {
                    var thisValue = jQuery(this).val();

                    if (thisValue == "") {
                        jQuery(this).siblings(".wizard-form-error").slideDown();
                        nextWizardStep = false;
                    } else {
                        jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
                });
                if (nextWizardStep) {
                    next.parents('.wizard-fieldset').removeClass("show", "400");
                    currentActiveStep.removeClass('active').addClass('activated');
                    currentActiveStep.parent().next().find('a').addClass('active', "400");
                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
                    jQuery(document).find('.wizard-fieldset').each(function () {
                        if (jQuery(this).hasClass('show')) {
                            var formAtrr = jQuery(this).attr('data-tab-content');
                            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
                                if (jQuery(this).attr('data-attr') == formAtrr) {
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                                } else {
                                    jQuery(this).removeClass('active');
                                }
                            });
                        }
                    });
                }
            });
            //click on previous button
            jQuery('.form-wizard-previous-btn').click(function () {
                var counter = parseInt(jQuery(".wizard-counter").text());
                ;
                var prev = jQuery(this);
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps li .active');
                prev.parents('.wizard-fieldset').removeClass("show", "400");
                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
                currentActiveStep.removeClass('active');
                currentActiveStep.parent().prev().find('a').removeClass('activated').addClass('active', "400");
                jQuery(document).find('.wizard-fieldset').each(function () {
                    if (jQuery(this).hasClass('show')) {
                        var formAtrr = jQuery(this).attr('data-tab-content');
                        jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
                            if (jQuery(this).attr('data-attr') == formAtrr) {
                                jQuery(this).addClass('active');
                                var innerWidth = jQuery(this).innerWidth();
                                var position = jQuery(this).position();
                                jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                            } else {
                                jQuery(this).removeClass('active');
                            }
                        });
                    }
                });
            });
            //click on form submit button
            jQuery(document).on("click", ".form-wizard .form-wizard-submit", function () {
                var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                parentFieldset.find('.wizard-required').each(function () {
                    var thisValue = jQuery(this).val();
                    if (thisValue == "") {
                        jQuery(this).siblings(".wizard-form-error").slideDown();
                    } else {
                        jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
                });
            });
            // focus on input field check empty or not
            jQuery(".form-control").on('focus', function () {
                var tmpThis = jQuery(this).val();
                if (tmpThis == '') {
                    jQuery(this).parent().addClass("focus-input");
                } else if (tmpThis != '') {
                    jQuery(this).parent().addClass("focus-input");
                }
            }).on('blur', function () {
                var tmpThis = jQuery(this).val();
                if (tmpThis == '') {
                    jQuery(this).parent().removeClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideDown("3000");
                } else if (tmpThis != '') {
                    jQuery(this).parent().addClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideUp("3000");
                }
            });
        });


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
    <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".attachment-btn").click(function () {
                $("#requirements").click();
            });
        });

        //pass your public key from tap's dashboard
        var tap = Tapjsli('pk_test_OanSHyNLEKBiFcUZMt8zDXds');

        var elements = tap.elements({});
        var style = {
            base: {
                color: '#535353',
                lineHeight: '18px',
                fontFamily: 'sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: 'rgba(0, 0, 0, 0.26)',
                    fontSize: '15px'
                }
            },
            invalid: {
                color: 'red'
            }
        };
        // input labels/placeholders
        var labels = {
            cardNumber: "Card Number",
            expirationDate: "MM/YY",
            cvv: "CVV",
            cardHolder: "Card Holder Name"
        };
        //payment options
        var paymentOptions = {
            currencyCode: ["KWD", "USD", "SAR"],
            labels: labels,
            TextDirection: 'ltr'
        }
        //create element, pass style and payment options
        var card = elements.create('card', {style: style}, paymentOptions);
        //mount element
        card.mount('#element-container');
        //card change event listener
        card.addEventListener('change', function (event) {
            if (event.BIN) {
                console.log(event.BIN)
            }
            if (event.loaded) {
                console.log("UI loaded :" + event.loaded);
                console.log("current currency is :" + card.getCurrency())
            }
            var displayError = document.getElementById('error-handler');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('form-container');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            tap.createToken(card).then(function (result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('error-handler');
                    errorElement.textContent = result.error.message;
                } else {
                    $('#payment_token').val(result.id);
                    $('#form-container').submit();
                }
            });
        });

        $('.extra-checkbox').change(function () {
            let extra_price_hidden = true;
            let price = 0;
            let total_price = {{$result['order_summary']['total'] ?? 0}};
            if ($(this).prop('checked')) {
                $.each($(".extra-checkbox:checked"), function () {
                    price += parseFloat($(this).data('value'));
                    total_price += parseFloat($(this).data('value'));
                });
                $('.extra_price').html(price);
                $('.extra_price_div').show();
            } else {
                $.each($(".extra-checkbox:checked"), function () {
                    if ($(this).prop('checked')) {
                        extra_price_hidden = false;
                    }
                });
                $.each($(".extra-checkbox:checked"), function () {
                    price += parseFloat($(this).data('value'));
                    total_price += parseFloat($(this).data('value'));
                });
                $('.extra_price').html(price);
                if (extra_price_hidden) {
                    $('.extra_price_div').hide();
                }
            }
            $('.total_price').html(total_price);
        });
    </script>
@endsection

@section('content')
    <div class="body-content">
        {{--        <section class="checkout-steps-section">--}}

        <section class="wizard-section checkout-steps-section">
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12">
                    <div class="form-wizard">
                        <form action="{{ url('checkout/send-order') }}" id="form-container" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="payment_token" value="">
                            <input type="hidden" name="service_id" value="{{request()->has('service_id')}}">
                            <input type="hidden" name="package" value="{{request()->has('package')}}">
                            <div class="form-wizard-header">
                                <div class="form-paginator">
                                    <div class="container">
                                        <div class="paginator-holder">
                                            <ul class="list-unstyled mb-0 nav justify-content-center list-unstyled form-wizard-steps clearfix">
                                                <li><a class="nav-link active"><span>1</span> @lang('site.order_details')</a></li>
                                                <li><a class="nav-link"><span>2</span> @lang('site.submit_requirements')</a></li>
                                                <li><a class="nav-link"><span>3</span> @lang('site.confirm_pay')</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container add_service_overview_block">
                                <div class="row justify-content-center">
                                    <div class="col-xl-12">
                                        <div class="add-order">

                                            <fieldset class="wizard-fieldset show">

                                                <!-- order-details-section -->
                                                <section class="order-details-section">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="info-wrapper">
                                                                    <div class="about-order-sec">
                                                                        <h3 class="">@lang('site.customize_your_package')</h3>
                                                                        <div class="media">
                                                                            <figure>
                                                                                @if(isset($result['service']->image) && !empty($result['service']->image) && !empty($result['service']->image->path) && Storage::exists('services/gallery/'.$result['service']->image->path))
                                                                                    <img src="{{ asset('storage/services/gallery/'.$result['service']->image->path) }}" class="main-img">
                                                                                @else
                                                                                    <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="img-fluid" alt="">
                                                                                @endif
                                                                            </figure>
                                                                            <div class="media-body">
                                                                                <p class="description">{{ $result['service']->title }}</p>
                                                                                <div class="total-meta d-flex align-item-center">
                                                                                    <p class="total-rate"><i class="fas fa-star"></i> 4.7</p>
                                                                                    <p class="total-reviews">1k+ reviews</p>
                                                                                </div>
                                                                                <div class="price-meta d-flex align-items-center">
                                                                                    <div class="price">
                                                                                        @if(request()->has('package') && request()->get('package') == 'standard')
                                                                                            {{ $result['service']->standard_price }}
                                                                                        @elseif(request()->has('package') && request()->get('package') == 'premium')
                                                                                            {{ $result['service']->premium_price }}
                                                                                        @else
                                                                                            {{ $result['service']->basic_price }}
                                                                                        @endif
                                                                                        @lang('site.sar')
                                                                                    </div>
{{--                                                                                    <div class="quantity d-flex align-items-center">--}}
{{--                                                                                        <label>Qty</label>--}}
{{--                                                                                        <div class="cs-number-input">--}}
{{--                                                                                            <i class="fas fa-minus decrease"></i>--}}
{{--                                                                                            <input type="text" name="" value="1">--}}
{{--                                                                                            <i class="fas fa-plus increase"></i>--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- order-about-plan-sec -->
                                                                    <div class="order-about-plan-sec">
                                                                        @if(request()->has('package') && request()->get('package') == 'standard')
                                                                            <h3 class="title">{{ $result['service']->standard_title }}</h3>
                                                                            <div class="description">{{ $result['service']->standard_description }}</div>
                                                                            <ul class="features d-flex align-items-center flex-wrap">
                                                                                @if(isset($result['service']->standard_services_list) && !empty($result['service']->standard_services_list))
                                                                                    @foreach($result['service']->standard_services_list as $key => $value)
                                                                                        <li class="active">
                                                                                            <i class="fas fa-check"></i>
                                                                                            {{ $value }}
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                    </div>
                                                                    @elseif(request()->has('package') && request()->get('package') == 'premium')
                                                                        <h3 class="title">{{ $result['service']->premium_title }}</h3>
                                                                        <div class="description">{{ $result['service']->premium_description }}</div>
                                                                        <ul class="features d-flex align-items-center flex-wrap">
                                                                            @if(isset($result['service']->premium_services_list) && !empty($result['service']->premium_services_list))
                                                                                @foreach($result['service']->premium_services_list as $key => $value)
                                                                                    <li class="active">
                                                                                        <i class="fas fa-check"></i>
                                                                                        {{ $value }}
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    @else
                                                                        <h3 class="title">{{ $result['service']->basic_title }}</h3>
                                                                        <div class="description">{{ $result['service']->basic_description }}</div>
                                                                        <ul class="features d-flex align-items-center flex-wrap">
                                                                            @if(isset($result['service']->basic_services_list) && !empty($result['service']->basic_services_list))
                                                                                @foreach($result['service']->basic_services_list as $key => $value)
                                                                                    <li class="active">
                                                                                        <i class="fas fa-check"></i>
                                                                                        {{ $value }}
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    @endif

                                                                    @if( !empty($result['service']->Extras()) && $result['service']->Extras()->count() > 0)
                                                                        <div class="order-extra-sec">
                                                                            <header>
                                                                                <h3>@lang('site.add_extras')</h3>
                                                                                <p>@lang('site.add_extras_text')</p>
                                                                            </header>
                                                                            <div class="extra-wrapper">
                                                                                @foreach($result['service']->Extras()->get() as $key => $value)
                                                                                    <div class="order-extra-feature-item d-flex">
                                                                                        <div class="custom-control custom-checkbox yallow">
                                                                                            <input type="checkbox" name="extra_services[]" class="custom-control-input extra-checkbox" data-value="{{$value->price}}" id="customCheck1{{$key}}">
                                                                                            <label class="custom-control-label" for="customCheck1{{$key}}"></label>
                                                                                        </div>
                                                                                        <div class="content">
                                                                                            <h4>{{ $value->title }}</h4>
                                                                                        </div>
                                                                                        <div class="price-wrapper d-flex align-items-center">
{{--                                                                                            <div class="cs-number-input">--}}
{{--                                                                                                <i class="fas fa-minus decrease"></i>--}}
{{--                                                                                                <input type="text" name="" value="1">--}}
{{--                                                                                                <i class="fas fa-plus increase"></i>--}}
{{--                                                                                            </div>--}}
                                                                                            <div class="price">
                                                                                                {{ $value->price }} @lang('site.sar')
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="order-summary-sec">
                                                                <h3>@lang('site.summary')</h3>
                                                                <div class="order-payment-summary">
                                                                    <div class="details">
                                                                        <div class="item d-flex align-items-center justify-content-between">
                                                                            <div class="title">@lang('site.subtotal') <i class="fas fa-circle"></i></div>
                                                                            <div class="price">{{ $result['order_summary']['total'] }} @lang('site.sar')</div>
                                                                        </div>
                                                                        {{--                                                            <div class="item d-flex align-items-center justify-content-between">--}}
                                                                        {{--                                                                <div class="title">Service Fee <i class="fas fa-circle"></i></div>--}}
                                                                        {{--                                                                <div class="price">15 SAR</div>--}}
                                                                        {{--                                                            </div>--}}
                                                                    </div>
                                                                    <div class="details extra_price_div" style="display: none">
                                                                        <div class="item d-flex align-items-center justify-content-between">
                                                                            <div class="title">@lang('site.extras') <i class="fas fa-circle"></i></div>
                                                                            <div class="price"><span class="extra_price"></span> @lang('site.sar')</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="total d-flex align-items-center justify-content-between">
                                                                        <div class="title">@lang('site.total')</div>
                                                                        <div class="price"><span class="total_price">{{ $result['order_summary']['total'] }}</span> @lang('site.sar')</div>
                                                                    </div>
                                                                    <div class="delivery-time d-flex align-items-center justify-content-between">
                                                                        <div class="title">@lang('site.delivery_time')</div>
                                                                        <div class="price">{{ $result['order_summary']['delivery_time'] }} @lang('site.days')</div>
                                                                    </div>
                                                                    <div class="actions">
                                                                        <a href="javascript:;" class="form-wizard-next-btn btn btn-yallow btn-block btn-lg">@lang('site.continue')
                                                                            (<span class="total_price">{{ $result['order_summary']['total'] }}</span> @lang('site.sar'))</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </section>

                                            </fieldset>

                                            <fieldset class="wizard-fieldset">
                                                <div class="add-service-content">

                                                    <div class="send-message-comp">
                                                        <div class="message-wrapper d-flex flex-column ">
                                                            <textarea name="requirements_details" class="form-control input_to_count" placeholder="Write your message"></textarea>
                                                            {{--                                            <div class="attachments d-flex align-items-center flex-wrap">--}}
                                                            {{--                                                <label>Attachmets:</label>--}}
                                                            {{--                                                <div class="attachment">--}}
                                                            {{--                                                    <i class="fas fa-paperclip"></i>--}}
                                                            {{--                                                    <span>image.png</span>--}}
                                                            {{--                                                    <a href="">--}}
                                                            {{--                                                        <i class="fas fa-times"></i>--}}
                                                            {{--                                                    </a>--}}
                                                            {{--                                                </div>--}}
                                                            {{--                                                <div class="attachment">--}}
                                                            {{--                                                    <i class="fas fa-paperclip"></i>--}}
                                                            {{--                                                    <span>File.docx</span>--}}
                                                            {{--                                                    <a href="">--}}
                                                            {{--                                                        <i class="fas fa-times"></i>--}}
                                                            {{--                                                    </a>--}}
                                                            {{--                                                </div>--}}
                                                            {{--                                            </div>--}}
                                                            <div class="message-controls d-flex align-items-center">
                                                                <p class="counter">
                                                                    <span class="current input_text_count">0</span>
                                                                    <span class="total">/ 2500</span>
                                                                </p>
                                                                <input type="file" id="requirements" name="attachments" multiple>
                                                                <button type="button" class="attachment-btn"><i class="fas fa-paperclip"></i></button>
                                                                {{--                                                <button type="button" data-target="#successfullySendRequest" data-toggle="modal" class="btn btn-yallow">Send</button>--}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <div class="add-service-footer d-flex align-items-center justify-content-between">
                                                            <a href="javascript:;" class="form-wizard-previous-btn btn btn-light">@lang('site.previous')</a>
                                                            <a href="javascript:;" class="form-wizard-next-btn btn btn-tamm add_service_overview_button">@lang('site.next')</a>
                                                        </div>
                                                    </div>
                                                </div>


                                            </fieldset>

                                            <fieldset class="wizard-fieldset">

                                                <div class="container add-service-content">
                                                    <div class="row">
                                                        <div class="col-lg-8">

                                                            <div class="info-wrapper">
                                                                <!-- payment-options-section -->
                                                                <section class="payment-options-section">
                                                                    <div class="accordion" id="paymentsAccordion">
                                                                        <div class="payment-option-item checked">
                                                                            <header class="head d-flex align-items-center" data-toggle="collapse" data-target="#payment-1">
                                                                                <div class="custom-control custom-radio yallow">
                                                                                    <input type="radio" checked id="option1" name="payment" class="custom-control-input">
                                                                                    <label class="custom-control-label" for="option1">
                                                                                        <h3>@lang('site.payment_gateway')</h3>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="img">
                                                                                    <img src="{{asset('assets/site/images/payments.png')}}" class="img-fluid" alt="">
                                                                                </div>
                                                                            </header>
{{--                                                                            <div id="payment-1"data-parent="#paymentsAccordion" class="payment-option-content collapse show">--}}
{{--                                                                                <div class="payment-form-wrapper">--}}
{{--                                                                                    <div id="element-container"></div>--}}
{{--                                                                                    <div id="error-handler" role="alert"></div>--}}
{{--                                                                                    <div id="success" style=" display: none;;position: relative;float: left;">--}}
{{--                                                                                        Success! Your token is <span id="token"></span>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
                                                                        </div>
                                                                        <div class="payment-option-item checked">
                                                                            <header class="head d-flex align-items-center" data-toggle="collapse" data-target="#payment-1">
                                                                                <div class="custom-control custom-radio yallow">
                                                                                    <input type="radio" id="option2" name="payment" class="custom-control-input">
                                                                                    <label class="custom-control-label" for="option2">
                                                                                        <h3>@lang('site.payment_cash')</h3>
                                                                                    </label>
                                                                                </div>
                                                                            </header>
                                                                        </div>

                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="order-summary-sec">
                                                                <h3>@lang('site.summary')</h3>
                                                                <div class="order-payment-summary">
                                                                    <div class="details">
                                                                        <div class="item d-flex align-items-center justify-content-between">
                                                                            <div class="title">@lang('site.subtotal') <i class="fas fa-circle"></i></div>
                                                                            <div class="price">{{ $result['order_summary']['total'] }} @lang('site.sar')</div>
                                                                        </div>
                                                                        {{--                                                            <div class="item d-flex align-items-center justify-content-between">--}}
                                                                        {{--                                                                <div class="title">Service Fee <i class="fas fa-circle"></i></div>--}}
                                                                        {{--                                                                <div class="price">15 SAR</div>--}}
                                                                        {{--                                                            </div>--}}
                                                                    </div>
                                                                    <div class="details extra_price_div" style="display: none">
                                                                        <div class="item d-flex align-items-center justify-content-between">
                                                                            <div class="title">@lang('site.extras') <i class="fas fa-circle"></i></div>
                                                                            <div class="price"><span class="extra_price"></span> @lang('site.sar')</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="total d-flex align-items-center justify-content-between">
                                                                        <div class="title">@lang('site.total')</div>
                                                                        <div class="price"><span class="total_price">{{ $result['order_summary']['total'] }}</span> @lang('site.sar')</div>
                                                                    </div>
                                                                    <div class="delivery-time d-flex align-items-center justify-content-between">
                                                                        <div class="title">@lang('site.delivery_time')</div>
                                                                        <div class="price">{{ $result['order_summary']['delivery_time'] }} @lang('site.days')</div>
                                                                    </div>
{{--                                                                    <div class="actions">--}}
{{--                                                                        <a href="javascript:;" class="form-wizard-next-btn btn btn-yallow btn-block btn-lg">@lang('site.continue')--}}
{{--                                                                            ({{ $result['order_summary']['total'] }} @lang('site.sar'))</a>--}}
{{--                                                                    </div>--}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
{{--                                                        <button id="tap-btn" style="float: @if(app()->getLocale() == 'ar') right @else left @endif">@lang('site.submit')</button>--}}
                                                        <div class="add-service-footer d-flex align-items-center justify-content-between" style="margin-top: 10px">
                                                            <a href="javascript:;" class="form-wizard-previous-btn btn btn-light">@lang('site.previous')</a>
                                                            <button type="submit" class="btn btn-tamm add_service_overview_button">@lang('site.submit')</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{--        </section>--}}

    </div>

@endsection
