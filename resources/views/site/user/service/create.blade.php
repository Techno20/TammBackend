@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style-rtl.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style.css') }}" />
    @endif
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
            <div class="form-paginator">
                <div class="container">
                    <div class="paginator-holder">
                        <ul class="list-unstyled mb-0 nav justify-content-center">
                            <li><a href="" class="nav-link active"><span>1</span> @lang('site.overview')</a></li>
                            <li><a href="" class="nav-link"><span>2</span> @lang('site.pricing')</a></li>
                            <li><a href="" class="nav-link"><span>3</span> @lang('site.service_description')</a></li>
                            <li><a href="" class="nav-link"><span>4</span> @lang('site.requirements')</a></li>
                            <li><a href="" class="nav-link"><span>5</span> @lang('site.gallery')</a></li>
                        </ul>
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
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label class="form-lable" for="service-title">@lang('site.service_title')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <textarea id="service-title" name="title" class="form-control input_to_count title" placeholder="@lang('site.service_title_hint')" rows="2"></textarea>
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


                            <div class="add-service-footer d-flex align-items-center justify-content-between">
{{--                                <a href="" class="btn btn-light">Previous</a>--}}
                                <a class="btn btn-tamm add_service_overview_button">@lang('site.next')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
