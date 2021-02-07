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
@endsection

@section('content')
    <div class="body-content">
        <section class="add-new-service">
            <header class="page-header">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h1>@lang('site.add_new_service')</h1>
                        <div class="page-action-btns">
                            <a href="" class="btn btn-tamm">@lang('site.save')</a>
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


            <div class="container">
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
                                        <textarea id="service-title" name="title" class="form-control input_to_count" placeholder="@lang('site.service_title_hint')" rows="2"></textarea>
                                        <div class="control-hint d-flex align-items-center justify-content-between">
                                            <p>@lang('site.just_perfect')!</p>
                                            <small><span class="input_text_count">0</span> / 80 @lang('site.max')</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label class="form-lable" for="cat-1">Category</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group d-flex align-items-center flex-wrap">
                                        <div class="cat-item mr-3">
                                            <select id="cat-1" class="form-control nice-select-me">
                                                @foreach(\App\Helpers\Helper::getMainCategoriesType() as $key => $value)
                                                    <option>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="cat-item">
                                            <select id="cat-2" class="form-control nice-select-me">
                                                <option selected disabled>Choose one ..</option>
                                                <option>Brand Voice & Tone</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label class="form-lable" for="cat-1">Metadata</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="serv-meta-wrapper d-flex mb-3">
                                        <div class="mr-3">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                                                   aria-controls="v-pills-home" aria-selected="true">INDUSTRY* <i class="fa fa-chevron-right fa-fw"></i></a>
                                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                                                   aria-controls="v-pills-profile" aria-selected="false">LANGUAGE* <i class="fa fa-chevron-right fa-fw"></i></a>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div class="checkboxes-content">
                                                        <div class="m-title d-flex align-items-center justify-content-between">
                                                            <p>Select your industry of expertise*</p>
                                                            <p>0 / 2</p>
                                                        </div>
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Crypto & Blockchain</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                            <label class="custom-control-label" for="customCheck2">Cyber Security</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                                            <label class="custom-control-label" for="customCheck3">Education</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                                            <label class="custom-control-label" for="customCheck4">Environmental</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                                            <label class="custom-control-label" for="customCheck5">Financial Services</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                                            <label class="custom-control-label" for="customCheck6">Government & Public Sector</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                                            <label class="custom-control-label" for="customCheck7">Crypto & Blockchain</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                                            <label class="custom-control-label" for="customCheck8">Cyber Security</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Education</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Environmental</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                    <div class="checkboxes-content">
                                                        <div class="m-title d-flex align-items-center justify-content-between">
                                                            <p>Select your industry of expertise*</p>
                                                            <p>0 / 2</p>
                                                        </div>
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Crypto & Blockchain</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                            <label class="custom-control-label" for="customCheck2">Cyber Security</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                                            <label class="custom-control-label" for="customCheck3">Education</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                                            <label class="custom-control-label" for="customCheck4">Environmental</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                                            <label class="custom-control-label" for="customCheck5">Financial Services</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                                            <label class="custom-control-label" for="customCheck6">Government & Public Sector</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                                            <label class="custom-control-label" for="customCheck7">Crypto & Blockchain</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                                            <label class="custom-control-label" for="customCheck8">Cyber Security</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox-contain mr-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Education</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox-contain ml-1">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                            <label class="custom-control-label" for="customCheck1">Environmental</label>
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
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label class="form-lable" for="service-tags">Search Tags</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput" class="tags-input form-control" />
                                        <small class="tags-help-text form-text text-right">5 tags maximum. Use letters and numbers only.</small>
                                    </div>
                                </div>
                            </div>


                            <div class="add-service-footer d-flex align-items-center justify-content-between">
{{--                                <a href="" class="btn btn-light">Previous</a>--}}
                                <a href="" class="btn btn-tamm">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
