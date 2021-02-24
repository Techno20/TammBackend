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
                                <h1>{{__('site.Change Password')}}</h1>
                            </header>
                            <div class="sec-content">
                                <div class="setting-security-sec gray-form">
                                    <div class="change-password ">
                                        <form action="{{url('user/me/update')}}" method="POST">
                                            @method('put')
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
                                                <label>{{__('site.New Password')}}</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4">
                                                <label>{{__('site.Confirm Password')}}</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="vpassword">
                                                    <small class="form-text">
                                                       {{__('site.characters_or_longer')}}
                                                    </small>
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
