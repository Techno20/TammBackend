@extends('site.layout.main')

@section('css')
@endsection

@section('js')
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
                                        <form action="{{url('user/update')}}" method="POST">
                                           
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
                                                    <select name="standard_services_list[]" multiple="multiple" class="form-control select2 select2-keywords"
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
                                                <label>البريد الالكتروني</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
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
                                            <button type="submit" class="btn btn-yallow">{{__('site.Save Chages')}}</button>
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
