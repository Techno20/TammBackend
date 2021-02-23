@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style-rtl.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style.css') }}" />
    @endif

    <style>

        .body-content{
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

            $('body').on('click','.btn-add-new-record',function () {
                $('.extra-container').append($('.extra-template').html());
            });
            $('body').on('click','.btn-remove-record',function () {
                $(this).parent().parent().html('');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('body').on('change','.select2',function () {
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

        function readURL(input) {
            // console.log();
            let _this = $(input);
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {
                    _this.closest('.file-upload').find('.image-upload-wrap').hide();

                    _this.closest('.file-upload').find('.file-upload-image').attr('src', e.target.result);
                    _this.closest('.file-upload').find('.file-upload-content').show();

                    _this.closest('.file-upload').find('.image-title').html(input.files[0].name);
                    console.log(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload(input);
            }
        }


    </script>
@endsection

@section('content')
    <div class="body-content">
        <section class="add-new-service">
            <header class="page-header">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h1>@lang('site.add_new_service')</h1>
{{--                        <div class="page-action-btns">--}}
{{--                            <a class="btn btn-tamm add_service_overview_button">@lang('site.save')</a>--}}
{{--                            <a class="btn btn-outline-secondary">@lang('site.save_and_review')</a>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </header>



            <section class="wizard-section">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-wizard">
                            <form action="{{ url('user/service/add') }}" method="post" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $service ? $service->id : '' }}">
                                <div class="form-wizard-header">
                                    <div class="form-paginator">
                                        <div class="container">
                                            <div class="paginator-holder">
                                                <ul class="list-unstyled mb-0 nav justify-content-center list-unstyled form-wizard-steps clearfix">
                                                    <li><a class="nav-link active"><span>1</span> @lang('site.overview')</a></li>
                                                    <li><a class="nav-link"><span>2</span> @lang('site.pricing')</a></li>
                                                    <li><a class="nav-link"><span>3</span> @lang('site.service_description')</a></li>
                                                    <li><a class="nav-link"><span>4</span> @lang('site.service_extra')</a></li>
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

                            <fieldset class="wizard-fieldset show">

                                <div class="form-group add-title">
                                    <h3>@lang('site.overview')</h3>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="service-title">@lang('site.service_title')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea id="service-title" name="title" class="form-control input_to_count title" placeholder="@lang('site.service_title_hint')" rows="2">{{ ($service && $service->title) ? $service->title : null }}</textarea>
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
                                                        <option {{ ($service && $service->main_category_type && $service->main_category_type == $key ) ? 'selected' : '' }} value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="cat-item">
                                                <select id="cat-2" class="form-control nice-select-me category_id" name="category_id">
                                                    <option selected disabled>@lang('site.chose_one')</option>
                                                    @foreach(\Helper::getCategories() as $key => $value)
                                                        <option {{ ($service && $service->category_id && $service->category_id == $key ) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
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
                                <div class="form-group add-title">
                                    <h3>@lang('site.pricing')</h3>
                                </div>

{{--                                basic pricing--}}
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>@lang('site.basic_pricing')</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-lable" for="basic-pricing-title">@lang('site.pricing_title')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" id="basic-pricing-title" value="{{ ($service && $service->basic_title) ? $service->basic_title : null }}"  name="basic_title" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_title')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="basic-pricing-price">@lang('site.pricing_price')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="0.01" value="{{ ($service && $service->basic_price) ? $service->basic_price : '0.01' }}" id="basic-pricing-price" name="basic_price"  class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_price')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="basic-pricing-delivery_days">@lang('site.pricing_delivery_days')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="1"  value="{{ ($service && $service->basic_delivery_days) ? $service->basic_delivery_days : '1' }}"  step="1" id="basic-pricing-delivery_days" name="basic_delivery_days" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_delivery_days')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="basic-pricing-description">@lang('site.pricing_description')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea id="basic-pricing-description" name="basic_description" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_description')" rows="2">{!!  ($service && $service->basic_description) ? $service->basic_description : ''  !!}</textarea>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="basic-pricing-services_list">@lang('site.pricing_services_list')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="basic_services_list[]"  multiple="multiple"  class="form-control select2 select2-keywords" placeholder="@lang('site.pricing_services_list')" id="basic-pricing-services_list" style="width: 100%;"></select>
                                            <span>@lang('site.service_list_hint')</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>@lang('site.standard_pricing')</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-lable" for="standard-pricing-title">@lang('site.pricing_title')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" id="standard-pricing-title" value="{{ ($service && $service->standard_title) ? $service->standard_title : null }}" name="standard_title" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_title')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="standard-pricing-price">@lang('site.pricing_price')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="0.01" value="0.01" id="standard-pricing-price" name="standard_price" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_price')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="standard-pricing-delivery_days">@lang('site.pricing_delivery_days')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="1" value="1" step="1" id="standard-pricing-delivery_days" name="standard_delivery_days" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_delivery_days')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="standard-pricing-description">@lang('site.pricing_description')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea id="standard-pricing-description" name="standard_description" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_description')" rows="2"></textarea>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="standard-pricing-services_list">@lang('site.pricing_services_list')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="standard_services_list[]"  multiple="multiple"  class="form-control select2 select2-keywords" placeholder="@lang('site.pricing_services_list')" id="standard-pricing-services_list" style="width: 100%;"></select>
                                            <span>@lang('site.service_list_hint')</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>@lang('site.premium_pricing')</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-lable" for="premium-pricing-title">@lang('site.pricing_title')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" id="premium-pricing-title" value="{{ ($service && $service->premium_title) ? $service->premium_title : null }}" name="premium_title" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_title')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="premium-pricing-price">@lang('site.pricing_price')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="0.01" value="0.01" id="premium-pricing-price" name="premium_price" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_price')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="premium-pricing-delivery_days">@lang('site.pricing_delivery_days')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" min="1" value="1" step="1" id="premium-pricing-delivery_days" name="premium_delivery_days" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_delivery_days')" />
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="premium-pricing-description">@lang('site.pricing_description')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <textarea id="premium-pricing-description" name="premium_description" class="form-control input_to_count title wizard-required" placeholder="@lang('site.pricing_description')" rows="2"></textarea>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="form-lable" for="premium-pricing-services_list">@lang('site.pricing_services_list')</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="premium_services_list[]"  multiple="multiple"  class="form-control select2 select2-keywords" placeholder="@lang('site.pricing_services_list')" id="premium-pricing-services_list" style="width: 100%;"></select>
                                            <span>@lang('site.service_list_hint')</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group clearfix">
                                    <div class="add-service-footer d-flex align-items-center justify-content-between">
                                        <a href="javascript:;" class="form-wizard-previous-btn btn btn-light">@lang('site.previous')</a>
                                        <a href="javascript:;" class="form-wizard-next-btn btn btn-tamm add_service_overview_button">@lang('site.next')</a>
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset class="wizard-fieldset">
                                <div class="add-service-content">
                                    <div class="form-group add-title">
                                        <h3>@lang('site.description')</h3>
                                    </div>
                                    <div class="add-service-desc-sec">
                                        <div class="form-group">
                                            <label for="service-title">@lang('site.service_description')</label>

{{--                                            <div id="editor"></div>--}}
                                            <textarea name="description" class="form-control input_to_count_2" cols="30" rows="10"></textarea>

                                            <div class="control-hint d-flex align-items-center justify-content-between">
                                                <p>@lang('site.just_perfect')!</p>
                                                <small><span class="input_text_count_2">0</span> / 80 @lang('site.max')</small>
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
                                <div class="add-service-content">
                                    <div class="form-group add-title">
                                        <h3>@lang('site.service_extra')</h3>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" id="basic-pricing-title" name="extras[]['title']" class="form-control input_to_count title" placeholder="@lang('site.pricing_title')" />
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="number" min="0.01" value="0.01"  id="basic-pricing-title" name="extras[]['price']" class="form-control input_to_count title" placeholder="@lang('site.pricing_price')" />
                                                <div class="wizard-form-error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-add-new-record">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="extra-template" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" id="basic-pricing-title" name="extras_title[]" class="form-control input_to_count title" placeholder="@lang('site.pricing_title')" />
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="number" min="0.01" value="0.01" id="basic-pricing-title" name="extras_price[]" class="form-control input_to_count title" placeholder="@lang('site.pricing_price')" />
                                                    <div class="wizard-form-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-remove-record">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="extra-container">

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
                                <div class="add-service-content">
                                    <div class="form-group add-title">
                                        <h3>@lang('site.gallery')</h3>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gallery-labl">
                                        <label>@lang('site.choose_images_videos')</label>
                                    </div>
                                    <div class="row mx-n2">
                                        <div class="col-lg-4 col-sm-6 px-2">
                                            <div class="file-upload mb-4">

                                                <div class="image-upload-wrap">
                                                    <input name="gallery[]" multiple="multiple" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                                    <div class="drag-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="42" viewBox="0 0 60 42">
                                                            <path class="a"
                                                                  d="M55,42H5a5.015,5.015,0,0,1-5-5V5A5.015,5.015,0,0,1,5,0H55a5.015,5.015,0,0,1,5,5V37a4.986,4.986,0,0,1-4.163,4.928,4.649,4.649,0,0,1-.822.073ZM32.234,29.689,45.483,40h9.531a2.753,2.753,0,0,0,.476-.042A2.982,2.982,0,0,0,58,37V28.566L44.082,20.215ZM2.012,37.264A3,3,0,0,0,5,40H42.226L21.95,24.228ZM2,5V34.882L21.453,22.163a1,1,0,0,1,1.16.048l7.995,6.218L43.375,18.219a1,1,0,0,1,1.14-.076L58,26.234V5a3,3,0,0,0-3-3H5A3,3,0,0,0,2,5Zm22,7a6,6,0,1,1,6,6A6.006,6.006,0,0,1,24,12Zm2,0a4,4,0,1,0,4-4A4,4,0,0,0,26,12Z"
                                                                  transform="translate(0 0)" fill="#9fa1b6" />
                                                        </svg>
                                                        <h3>@lang('site.click_hear')
                                                            <span>@lang('site.browse')</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content">
                                                    <img class="file-upload-image" src="#" alt="your image" />
                                                    <div class="image-title-wrap">
                                                        <div class="image-title"></div>
                                                        <button type="button" onclick="removeUpload(this)" class="remove-image"><i
                                                                class="fa fa-times fa-fw"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="add-service-footer d-flex align-items-center justify-content-between">
                                            <a href="javascript:;" class="form-wizard-previous-btn btn btn-light">@lang('site.previous')</a>
                                            <button type="submit" class="form-wizard-submit btn btn-tamm add_service_overview_button">@lang('site.save')</button>
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

        </section>

    </div>

@endsection
