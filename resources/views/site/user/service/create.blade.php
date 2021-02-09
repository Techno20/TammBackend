@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style-rtl.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style.css') }}" />
    @endif

    <style>
        .wizard-content-left {
            background-blend-mode: darken;
            background-color: rgba(0, 0, 0, 0.45);
            background-image: url("https://i.ibb.co/X292hJF/form-wizard-bg-2.jpg");
            background-position: center center;
            background-size: cover;
            height: 100vh;
            padding: 30px;
        }
        .wizard-content-left h1 {
            color: #ffffff;
            font-size: 38px;
            font-weight: 600;
            padding: 12px 20px;
            text-align: center;
        }

        .form-wizard {
            color: #888888;
            padding: 30px;
        }
        .form-wizard .wizard-form-radio {
            display: inline-block;
            margin-left: 5px;
            position: relative;
        }
        .form-wizard .wizard-form-radio input[type="radio"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            background-color: #dddddd;
            height: 25px;
            width: 25px;
            display: inline-block;
            vertical-align: middle;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
        }
        .form-wizard .wizard-form-radio input[type="radio"]:focus {
            outline: 0;
        }
        .form-wizard .wizard-form-radio input[type="radio"]:checked {
            background-color: #fb1647;
        }
        .form-wizard .wizard-form-radio input[type="radio"]:checked::before {
            content: "";
            position: absolute;
            width: 10px;
            height: 10px;
            display: inline-block;
            background-color: #ffffff;
            border-radius: 50%;
            left: 1px;
            right: 0;
            margin: 0 auto;
            top: 8px;
        }
        .form-wizard .wizard-form-radio input[type="radio"]:checked::after {
            content: "";
            display: inline-block;
            webkit-animation: click-radio-wave 0.65s;
            -moz-animation: click-radio-wave 0.65s;
            animation: click-radio-wave 0.65s;
            background: #000000;
            content: '';
            display: block;
            position: relative;
            z-index: 100;
            border-radius: 50%;
        }
        .form-wizard .wizard-form-radio input[type="radio"] ~ label {
            padding-left: 10px;
            cursor: pointer;
        }
        .form-wizard .form-wizard-header {
            text-align: center;
        }
        .form-wizard .form-wizard-next-btn, .form-wizard .form-wizard-previous-btn, .form-wizard .form-wizard-submit {
            background-color: #d65470;
            color: #ffffff;
            display: inline-block;
            min-width: 100px;
            min-width: 120px;
            padding: 10px;
            text-align: center;
        }
        .form-wizard .form-wizard-next-btn:hover, .form-wizard .form-wizard-next-btn:focus, .form-wizard .form-wizard-previous-btn:hover, .form-wizard .form-wizard-previous-btn:focus, .form-wizard .form-wizard-submit:hover, .form-wizard .form-wizard-submit:focus {
            color: #ffffff;
            opacity: 0.6;
            text-decoration: none;
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
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
        }
        .form-wizard .form-wizard-previous-btn {
            background-color: #fb1647;
        }
        .form-wizard .form-control {
            font-weight: 300;
            height: auto !important;
            padding: 15px;
            color: #888888;
            background-color: #f1f1f1;
            border: none;
        }
        .form-wizard .form-control:focus {
            box-shadow: none;
        }
        .form-wizard .form-group {
            position: relative;
            margin: 25px 0;
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

    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            if ($('select.nice-select-me').length != 0) {
                $('select.nice-select-me').niceSelect();
            }

            if ($('.tags-input').length != 0) {
                $('.tags-input').val();
            }
        })
    </script>
    <script>
        $(document).ready(function () {
            /*
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

        jQuery(document).ready(function() {
            // click on next button
            jQuery('.form-wizard-next-btn').click(function() {
                var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps li .active');
                var next = jQuery(this);
                var nextWizardStep = true;
                parentFieldset.find('.wizard-required').each(function(){
                    var thisValue = jQuery(this).val();

                    if( thisValue == "") {
                        jQuery(this).siblings(".wizard-form-error").slideDown();
                        nextWizardStep = false;
                    }
                    else {
                        jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
                });
                if( nextWizardStep) {
                    next.parents('.wizard-fieldset').removeClass("show","400");
                    currentActiveStep.removeClass('active').addClass('activated');
                    currentActiveStep.parent().next().find('a').addClass('active',"400");
                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
                    jQuery(document).find('.wizard-fieldset').each(function(){
                        if(jQuery(this).hasClass('show')){
                            var formAtrr = jQuery(this).attr('data-tab-content');
                            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                                if(jQuery(this).attr('data-attr') == formAtrr){
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                                }else{
                                    jQuery(this).removeClass('active');
                                }
                            });
                        }
                    });
                }
            });
            //click on previous button
            jQuery('.form-wizard-previous-btn').click(function() {
                var counter = parseInt(jQuery(".wizard-counter").text());;
                var prev =jQuery(this);
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps li .active');
                prev.parents('.wizard-fieldset').removeClass("show","400");
                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
                currentActiveStep.removeClass('active');
                currentActiveStep.parent().prev().find('a').removeClass('activated').addClass('active',"400");
                jQuery(document).find('.wizard-fieldset').each(function(){
                    if(jQuery(this).hasClass('show')){
                        var formAtrr = jQuery(this).attr('data-tab-content');
                        jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                            if(jQuery(this).attr('data-attr') == formAtrr){
                                jQuery(this).addClass('active');
                                var innerWidth = jQuery(this).innerWidth();
                                var position = jQuery(this).position();
                                jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                            }else{
                                jQuery(this).removeClass('active');
                            }
                        });
                    }
                });
            });
            //click on form submit button
            jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
                var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                parentFieldset.find('.wizard-required').each(function() {
                    var thisValue = jQuery(this).val();
                    if( thisValue == "" ) {
                        jQuery(this).siblings(".wizard-form-error").slideDown();
                    }
                    else {
                        jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
                });
            });
            // focus on input field check empty or not
            jQuery(".form-control").on('focus', function(){
                var tmpThis = jQuery(this).val();
                if(tmpThis == '' ) {
                    jQuery(this).parent().addClass("focus-input");
                }
                else if(tmpThis !='' ){
                    jQuery(this).parent().addClass("focus-input");
                }
            }).on('blur', function(){
                var tmpThis = jQuery(this).val();
                if(tmpThis == '' ) {
                    jQuery(this).parent().removeClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideDown("3000");
                }
                else if(tmpThis !='' ){
                    jQuery(this).parent().addClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideUp("3000");
                }
            });
        });


    </script>
@endsection

@section('content')
    <div class="body-content">
        <section class="add-new-service">
            <header class="page-header">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h1>@lang('site.add_new_service')</h1>
                        <div class="page-action-btns">
                            <a class="btn btn-tamm add_service_overview_button">@lang('site.save')</a>
                            <a class="btn btn-outline-secondary">@lang('site.save_and_review')</a>
                        </div>
                    </div>
                </div>
            </header>



            <section class="wizard-section">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-wizard">
                            <form action="" method="post" role="form">
                                <div class="form-wizard-header">
                                    <div class="form-paginator">
                                        <div class="container">
                                            <div class="paginator-holder">
                                                <ul class="list-unstyled mb-0 nav justify-content-center list-unstyled form-wizard-steps clearfix">
                                                    <li><a class="nav-link active"><span>1</span> @lang('site.overview')</a></li>
                                                    <li><a class="nav-link"><span>2</span> @lang('site.pricing')</a></li>
                                                    <li><a class="nav-link"><span>3</span> @lang('site.service_description')</a></li>
                                                    <li><a class="nav-link"><span>4</span> @lang('site.requirements')</a></li>
                                                    <li><a class="nav-link"><span>5</span> @lang('site.gallery')</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>





            <div class="container add_service_overview_block">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="add-service-content">
                            <div class="form-group add-title">
                                <h3>@lang('site.overview')</h3>
                            </div>


                            <fieldset class="wizard-fieldset show">


                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="service-title">@lang('site.service_title')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea id="service-title" name="title" class="form-control input_to_count title wizard-required" placeholder="@lang('site.service_title_hint')" rows="2"></textarea>
                                            <div class="wizard-form-error"></div>
                                            <div class="control-hint d-flex align-items-center justify-content-between">
                                                <p>@lang('site.just_perfect')!</p>
                                                <small><span class="input_text_count">0</span> / 80 @lang('site.max')</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="cat-1">@lang('site.category')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group d-flex align-items-center flex-wrap">
                                            <div class="cat-item mr-3">
                                                <select id="cat-1" class="form-control nice-select-me main_category_type" name="main_category_type">
                                                    <option selected disabled>@lang('site.chose_one')</option>
                                                    @foreach(\Helper::getMainCategoriesType(false,app()->getLocale()) as $key => $value)
                                                        <option value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="cat-item">
                                                <select id="cat-2" class="form-control nice-select-me category_id" name="category_id">
                                                    <option selected disabled>@lang('site.chose_one')</option>
                                                    @foreach(\Helper::getCategories() as $key => $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="cat-1">@lang('site.metadata')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="serv-meta-wrapper d-flex mb-3">
                                            <div class="mr-3">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                                                       aria-controls="v-pills-profile" aria-selected="false">@lang('site.language') <i class="fa fa-chevron-right fa-fw"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="tab-content" id="v-pills-tabContent">

                                                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                        <div class="checkboxes-content">
                                                            {{--<div class="m-title d-flex align-items-center justify-content-between">--}}
                                                            {{--<p>Select your industry of expertise*</p>--}}
                                                            {{--<p>0 / 2</p>--}}
                                                            {{--</div>--}}
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox-contain mr-1">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" checked class="custom-control-input language" id="customCheck1" value="ar" name="language">
                                                                                <label class="custom-control-label" for="customCheck1">@lang('site.arabic')</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox-contain ml-1">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" checked class="custom-control-input language" id="customCheck2" value="en" name="language">
                                                                                <label class="custom-control-label" for="customCheck2">@lang('site.english')</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="form-row">--}}
                                {{--<div class="col-md-3">--}}
                                {{--<label class="form-lable" for="service-tags">Search Tags</label>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-9">--}}
                                {{--<div class="form-group">--}}
                                {{--<input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput" class="tags-input form-control" />--}}
                                {{--<small class="tags-help-text form-text text-right">5 tags maximum. Use letters and numbers only.</small>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}


                                <div class="form-group clearfix">
                                    <div class="add-service-footer d-flex align-items-center justify-content-between">
                                        {{--                                <a href="" class="btn btn-light">Previous</a>--}}
                                        <a href="javascript:;" class="form-wizard-next-btn btn btn-tamm add_service_overview_button">@lang('site.next')</a>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="wizard-fieldset">
                                <h5>Account Information</h5>
                                <div class="form-group">
                                    <input type="email" class="form-control wizard-required" id="email">
                                    <label for="email" class="wizard-form-text-label">Email*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="username">
                                    <label for="username" class="wizard-form-text-label">User Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control wizard-required" id="pwd">
                                    <label for="pwd" class="wizard-form-text-label">Password*</label>
                                    <div class="wizard-form-error"></div>
                                    <span class="wizard-password-eye"><i class="far fa-eye"></i></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control wizard-required" id="cpwd">
                                    <label for="cpwd" class="wizard-form-text-label">Confirm Password*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                </div>
                            </fieldset>
                            <fieldset class="wizard-fieldset">
                                <h5>Bank Information</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="bname">
                                    <label for="bname" class="wizard-form-text-label">Bank Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="brname">
                                    <label for="brname" class="wizard-form-text-label">Branch Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="acname">
                                    <label for="acname" class="wizard-form-text-label">Account Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="acon">
                                    <label for="acon" class="wizard-form-text-label">Account Number*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                </div>
                            </fieldset>
                            <fieldset class="wizard-fieldset">
                                <h5>Payment Information</h5>
                                <div class="form-group">
                                    Payment Type
                                    <div class="wizard-form-radio">
                                        <input name="radio-name" id="mastercard" type="radio">
                                        <label for="mastercard">Master Card</label>
                                    </div>
                                    <div class="wizard-form-radio">
                                        <input name="radio-name" id="visacard" type="radio">
                                        <label for="visacard">Visa Card</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="honame">
                                    <label for="honame" class="wizard-form-text-label">Holder Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" id="cardname">
                                            <label for="cardname" class="wizard-form-text-label">Card Number*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" id="cvc">
                                            <label for="cvc" class="wizard-form-text-label">CVC*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">Expiry Date</div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Date</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                                <option value="">4</option>
                                                <option value="">5</option>
                                                <option value="">6</option>
                                                <option value="">7</option>
                                                <option value="">8</option>
                                                <option value="">9</option>
                                                <option value="">10</option>
                                                <option value="">11</option>
                                                <option value="">12</option>
                                                <option value="">13</option>
                                                <option value="">14</option>
                                                <option value="">15</option>
                                                <option value="">16</option>
                                                <option value="">17</option>
                                                <option value="">18</option>
                                                <option value="">19</option>
                                                <option value="">20</option>
                                                <option value="">21</option>
                                                <option value="">22</option>
                                                <option value="">23</option>
                                                <option value="">24</option>
                                                <option value="">25</option>
                                                <option value="">26</option>
                                                <option value="">27</option>
                                                <option value="">28</option>
                                                <option value="">29</option>
                                                <option value="">30</option>
                                                <option value="">31</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Month</option>
                                                <option value="">jan</option>
                                                <option value="">Feb</option>
                                                <option value="">March</option>
                                                <option value="">April</option>
                                                <option value="">May</option>
                                                <option value="">June</option>
                                                <option value="">Jully</option>
                                                <option value="">August</option>
                                                <option value="">Sept</option>
                                                <option value="">Oct</option>
                                                <option value="">Nov</option>
                                                <option value="">Dec</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Years</option>
                                                <option value="">2019</option>
                                                <option value="">2020</option>
                                                <option value="">2021</option>
                                                <option value="">2022</option>
                                                <option value="">2023</option>
                                                <option value="">2024</option>
                                                <option value="">2025</option>
                                                <option value="">2026</option>
                                                <option value="">2027</option>
                                                <option value="">2028</option>
                                                <option value="">2029</option>
                                                <option value="">2030</option>
                                                <option value="">2031</option>
                                                <option value="">2032</option>
                                                <option value="">2033</option>
                                                <option value="">2034</option>
                                                <option value="">2035</option>
                                                <option value="">2036</option>
                                                <option value="">2037</option>
                                                <option value="">2038</option>
                                                <option value="">2039</option>
                                                <option value="">2040</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-submit float-right">Submit</a>
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

        </section>

    </div>

@endsection
