@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/fileinput.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/site/css/fileinput-rtl.min.css') }}"/>
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/fileinput.min.css') }}"/>
    @endif

    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap-multiselect.css') }}" type="text/css">
    <style>
        .multiselect-native-select .btn-group.show{
            width: 100% !important;
        }

        .dropdown-menu.show
        {
            width: 100% !important;
        }
        .multiselect-container
        {
            width: 100% !important;
        }

        .btn-group.show > .multiselect
        {
            text-align: right !important;
        }

        .multiple-select
        {
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('assets/site/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/theme.min.js') }}"></script>
    <script>
        function enableFileInput(selector, init = [], init_config = [], overwrite = true, deleteBtn = false) {
            $(selector).fileinput({
                theme: "fas",
                showDrag: false,
                deleteExtraData: {
                    '_token': '{{csrf_token()}}',
                },
                browseClass: "btn btn-info",
                browseIcon: "<i class='la la-file'></i>",
                removeClass: "btn btn-danger",
                removeIcon: "<i class='la la-trash-o'></i>",
                showRemove: false,
                showCancel: false,
                showUpload: false,
                showPreview: true,
                initialPreview: init,
                initialPreviewShowDelete: deleteBtn,
                initialPreviewAsData: true, // defaults markup
                initialPreviewConfig: init_config,
                initialPreviewFileType: 'image',
                overwriteInitial: overwrite,
                browseOnZoneClick: true,
                maxFileCount: 6,
                browseLabel: "@lang('site.text_browse')",
                removeLabel: "@lang('site.text_delete')",
                msgPlaceholder: "@lang('site.text_select_files') {files}...",
                msgSelected: "@lang('site.text_selected') {n} {files}",
                fileSingle: "@lang('site.text_one_files')",
                filePlural: "@lang('site.text_multi_files')",
                dropZoneTitle: "@lang('site.text_drag_drop_files_here') &hellip;",
                msgZoomModalHeading: "@lang('site.text_file_details')",
                dropZoneClickTitle: '<br>(@lang('site.text_click_to_browse'))',
                @if(app()->getLocale() == 'ar')
                rtl: true,
                @endif
            });
        }

        @if(auth()->check() && auth()->user()->avatar_full_path)
            enableFileInput('#avatar', ['{{auth()->user()->avatar_full_path}}']);
        @else
            enableFileInput('#avatar');
        @endif
    </script>

    <script type="text/javascript" src="{{ asset('assets/site/js/bootstrap-multiselect.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
        });
    </script>
@endsection

@section('content')

    <div class="body-content">
        <!-- account-setting-page -->
        <section class="account-setting-page">
            <div class="container">
                <div class="row">
                    @include('site.layout.common.settings')
                    <div class="col-xl-8">
                        <div class="setting-sidebar-overlay"></div>
                        <button type="button" id="openSettingSidebar" class="btn setting-sidebar-toggle"><i class="fas fa-bars"></i></button>
                        <div class="account-setting-body">
                            <header class="setting-body-header">
                                <h1>تعديل الملف الشخصي</h1>
                            </header>
                            <div class="sec-content">
                                <div class="setting-security-sec gray-form">

                                    @if (isset($success))
                                        <div class="alert alert-success" role="alert">
                                            {{$success}}
                                        </div>
                                    @endif

                                    <div class="change-password ">
                                        <form action="{{url('user/update')}}" method="POST" enctype="multipart/form-data">

                                            @csrf

                                        {{-- <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>Current Password</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>الاسم</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>عني</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <textarea type="text" class="form-control" name="about_me">{{$user->about_me}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>التعليم</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <select name="educations[]" multiple="multiple" class="form-control select2 select2-keywords"
                                                            placeholder="@lang('site.pricing_services_list')" id="standard-pricing-services_list" style="width: 100%;">
                                                        {{-- @if($service && $service->standard_services_list && count($service->standard_services_list)) --}}
                                                            @foreach($user->educations as $item)
                                                                <option selected>{{$item}}</option>
                                                            @endforeach
                                                        {{-- @endif --}}
                                                    </select>
                                                    <span>@lang('site.service_list_hint')</span>
                                                </div>
                                            </div>
                                        </div>


                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <label>المهارات</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group multiple-select">
                                                        <select id="example-getting-started" multiple="multiple" name="skills[]">
                                                            @forelse($allSkills as $skill)
                                                                <option value="{{ $skill->id }}" @if($userSkills->contains('skill_id' , $skill->id)) selected @endif>{{ $skill->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <label>الدولة</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <select class="form-control" name="country_id">
                                                            <option selected disabled>@lang('site.select_country')</option>
                                                            @forelse($countries as $country)
                                                                <option value="{{ $country->id }}" @if($user->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>البريد الالكتروني</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>الصورة الشخصية</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input name="avatar" id="avatar" class="fileinput form-control" type='file' accept="image/*"/>
                                                </div>
                                            </div>

                                        </div>
                                        <header class="setting-body-header">
                                            <h1>روابط التواصل الاجتماعي</h1>
                                        </header>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>الفيس بوك</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="facebook_url" value="{{$user->facebook_url}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>تويتر</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="twitter_url" value="{{$user->twitter_url}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>انستغرام</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="instagram_url" value="{{$user->instagram_url}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>لنكد ان</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="linkedin_url" value="{{$user->linkedin_url}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="actions text-right">
                                            <button type="submit" class="btn btn-yallow">{{__('site.Save Changes')}}</button>
                                        </div>
                                    </form>
                                    </div>
                                    {{-- <div class="additional-info">
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>PHONE VERIFICATION</label>
                                            </div>
                                            <div class="col-lg-5 col-md-8">
                                                <div class="notes">
                                                    <p>Your phone is not verified with Fiverr. Click Verify Now to complete phone verification</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="form-group verify-phone-wrapper">
                                                    <button type="button" class="btn btn-yallow">Verify Now</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>SECURITY QUESTION</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <select class="custom-select cs-select-style">
                                                        <option selected>Choose your quastion</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="your answer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="actions text-right mt-4">
                                            <button type="button" class="btn btn-white">Cancel</button>
                                            <button type="button" class="btn btn-yallow ml-2">Submit</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account-setting-page -->

    </div>
@endsection
