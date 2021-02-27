@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">
        <!-- freelancer-user-profile-page -->
        <section class="freelancer-user-profile-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- freelancer-profile-box -->
                        <div class="freelancer-profile-box">
                            <div class="status-bar d-flex align-items-center">
{{--                                    <span class="status ml-auto">--}}
{{--                                        <i class="fas fa-circle"></i>--}}
{{--                                        Online--}}
{{--                                    </span>--}}
                            </div>
                            <div class="user">
                                <figure>
                                    <img src="{{ $user->avatar_full_path }}" alt="">
                                    <p class="rate">
                                        <i class="fas fa-star"></i>
                                        {{ $user->getUserServicesReviews() }}
                                    </p>
                                </figure>
                                <h3>{{ $user->name }}</h3>
                                <div class="brief">
                                    {{ $user->about_me }}
                                </div>
                                <div class="actions">
                                    <button class="btn btn-yallow" data-toggle="modal" data-target="#sendMessageModal">@lang('site.contact_seller')</button>
                                </div>
                            </div>
                            <div class="user-info form-row">
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <label>@lang('site.from')</label>
                                        <p>{{ $user->Country ? $user->Country->name : '' }}</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19.999" height="17.578" viewBox="0 0 19.999 17.578">
                                                <g id="calendar" transform="translate(0 -0.039)">
                                                    <path id="Path" d="M.585,9.375H15.9a.587.587,0,0,0,.375-.136c.147-.123,3.5-3.009,3.707-9.239H3.534C3.33,5.655.241,8.313.209,8.34A.587.587,0,0,0,.585,9.375Z" transform="translate(0 4.726)" fill="currentcolor"/>
                                                    <path id="Path-2" data-name="Path" d="M15.859,1.172H12.93V.586a.586.586,0,0,0-1.172,0v.586H8.789V.586a.586.586,0,0,0-1.172,0v.586H4.688V.586a.586.586,0,0,0-1.172,0v.586H.586A.58.58,0,0,0,0,1.758V3.516H16.445V1.758A.58.58,0,0,0,15.859,1.172Z" transform="translate(3.554 0.039)" fill="currentcolor"/>
                                                    <path id="Path-3" data-name="Path" d="M13.472,4.4a1.763,1.763,0,0,1-1.128.409H0V6.568a.586.586,0,0,0,.586.586H15.859a.586.586,0,0,0,.586-.586V0A11.613,11.613,0,0,1,13.472,4.4Z" transform="translate(3.554 10.463)" fill="currentcolor"/>
                                                </g>
                                            </svg>

                                        </div>
                                        <label>@lang('site.mbr_since')</label>
                                        <p>{{ date('M Y',strtotime($user->created_at)) }}</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <label>@lang('site.rspns_time')</label>
                                        <p>2 hours</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- freelancer-profile-box -->


                        <!-- user-badge-box -->
{{--                        <div class="user-successfully-completed-box">--}}
{{--                            <h3 class="m-title">Successfully completed</h3>--}}
{{--                            <div class="content">--}}
{{--                                <div class="media align-items-center">--}}
{{--                                    <figure>--}}
{{--                                        <img src="{{ asset('assets/site/images/award.png') }}" class="img-fluid" alt="">--}}
{{--                                    </figure>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5>Online Freelancing Essentials: be a succe..</h5>--}}
{{--                                        <p>Jun 2020</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media align-items-center">--}}
{{--                                    <figure>--}}
{{--                                        <img src="{{ asset('assets/site/images/award.png') }}" class="img-fluid" alt="">--}}
{{--                                    </figure>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5>Online Freelancing Essentials: be a succe..</h5>--}}
{{--                                        <p>Dec 2021</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- user-badge-box -->
                        <!-- freelancer-info-box -->
                        <div class="freelancer-info-box">
                            <div class="description-sec">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">@lang('site.description')</h3>
                                </header>
                                <div class="content">
                                    {{ $user->about_me }}
                                </div>
                            </div>
{{--                            <div class="languages">--}}
{{--                                <header class="box-header d-flex align-items-center justify-content-between">--}}
{{--                                    <h3 class="m-title">Languages</h3>--}}
{{--                                </header>--}}
{{--                                <div class="content d-flex flex-wrap">--}}
{{--                                    <p>English  - <span>Basic</span></p>--}}
{{--                                    <p>Korean (한국어) - <span>Conversational</span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="social-accounts">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">@lang('site.linked_accounts')</h3>
                                </header>
                                <div class="content ">
                                    <div class="accounts-links d-flex flex-wrap">
                                        @if(!empty($user->facebook_url))
                                            <a href="{{ $user->facebook_url }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        @endif
                                        @if(!empty($user->instagram_url))
                                            <a href="{{ $user->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                        @endif
                                        @if(!empty($user->twitter_url))
                                            <a href="{{ $user->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                        @endif
                                        @if(!empty($user->linkedin_url))
                                            <a href="{{ $user->linkedin_url }}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="skills">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">@lang('site.skills')</h3>
                                </header>
                                <div class="content d-flex flex-wrap">
                                    @if(isset($user->skills) && !empty($user->skills) && $user->skills->count() > 0)
                                        @foreach($user->skills as $key => $value)
                                            <span class="item">{{ $value->name }}</span>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                                    @endif
                                </div>
                            </div>
                            <div class="education">
                                <header class="box-header d-flex align-items-center justify-content-between">
                                    <h3 class="m-title">@lang('site.education')</h3>                                    </header>
                                <div class="content ">
                                    <div class="item">
                                        @if(isset($user->educations) && !empty($user->educations) && count($user->educations) > 0)
                                            @foreach($user->educations as $key => $value)
                                                <h5>{{ $value }}</h5>
                                            @endforeach
                                        @else
                                            <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
{{--                            <div class="certifications">--}}
{{--                                <header class="box-header d-flex align-items-center justify-content-between">--}}
{{--                                    <h3 class="m-title">Certifications</h3>--}}
{{--                                </header>--}}
{{--                                <div class="content ">--}}
{{--                                    <div class="item">--}}
{{--                                        <h5>User Experience Design</h5>--}}
{{--                                        <p>The Team W 2019</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="item">--}}
{{--                                        <h5>Advanced User Experience Design</h5>--}}
{{--                                        <p>The Team W 2019</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!-- freelancer-info-box -->
                    </div>
                    <div class="col-xl-6 offset-xl-1 col-lg-7">
                        <!-- user-services-section -->
                        <section class="user-services-section">
                            <header class="p-header-2 d-flex align-items-center justify-content-between">
                                <h2>@lang('site.services')</h2>
                            </header>
                            <div class="sec-content">
                                <div class="row">
                                    @if(isset($services) && !empty($services) && count($services->toArray()) > 0)
                                        @foreach($services as $key => $value)

                                            <div class="col-sm-6">
                                                <div class="service-item-2">
                                                    <div class="top">
                                                        <div class="service-item-slider owl-carousel">
                                                            @if(isset($value->image) && !empty($value->image) && !empty($value->image->path) && Storage::exists('services/gallery/'.$value->image->path))
                                                                <img src="{{ asset('storage/services/gallery/'.$value->image->path) }}" class="main-img">
                                                            @else
                                                                <img src="{{ asset('assets/site/images/services/s-2.png') }}" class="main-img">
                                                            @endif
                                                        </div>
{{--                                                        <a href="" class="add-to-favorites"><i class="fas fa-heart"></i></a>--}}
                                                    </div>
                                                    <div class="details">
                                                        <div class="serv-author media">
                                                            @if(isset($value->user) && !empty($value->user))
                                                                @if(file_exists(asset('uploads/users/'.$value->user->avatar)))
                                                                    <img src="{{ asset('uploads/users/'.$value->user->avatar) }}" class="author-img">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/user.png') }}" class="author-img">
                                                                @endif
                                                                <div class="media-body">
                                                                    <h4>{{ $value->user->name }}</h4>
                                                                    {{--                                                        <p>Creator</p>--}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <h3 class="title">
                                                            <a href="{{ url('service/show/'.$value->id) }}">{{ $value->title }}</a>
                                                        </h3>
                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="price">
                                                                <label>@lang('site.starting')</label>
                                                                <p>{{ $value->basic_price }} @lang('site.sar')</p>
                                                            </div>
                                                            <div class="total-meta">
                                                                <p class="total-rate"><i class="fas fa-star"></i> {{ $value->rating_avg }}</p>
                                                                <p class="total-sell">{{ $value->Orders()->count() }} @lang('site.sell')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        @endforeach
                                        <div class="col-sm-12 text-center"><div class="pagination text-center">{{ $services->links() }}</div></div>
                                    @else
                                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                                    @endif
                                </div>

{{--                                <div class="user-reviews-sec">--}}
{{--                                    <header class="head d-flex align-items-center">--}}
{{--                                        <div class="rate d-flex align-items-center">--}}
{{--                                            <span class="rate-count">3,774 Reviews</span>--}}
{{--                                            <div class="stars">--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                            </div>--}}
{{--                                            <span class="rate-text">4.8</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="sort d-flex align-items-center ml-auto">--}}
{{--                                            <label>Sort By</label>--}}
{{--                                            <div class="cs-dropdown-select dropdown">--}}
{{--                                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    Most Relevant--}}
{{--                                                    <i class="fas fa-chevron-down"></i>--}}
{{--                                                </button>--}}
{{--                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                                    <a class="dropdown-item" href="#">Most Relevant 1</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Most Relevant 2</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Most Relevant 3</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </header>--}}
{{--                                    <div class="review-list-sec">--}}
{{--                                        <div class="review-box">--}}
{{--                                            <div class="head d-flex">--}}
{{--                                                <div class="review-author media align-items-center">--}}
{{--                                                    <figure>--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-1.png') }}" class="author-img" alt="">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/pal-flag.png') }}" class="author-flag" alt="">--}}
{{--                                                    </figure>--}}
{{--                                                    <div class="media-body">--}}
{{--                                                        <h4>Asaka Chimako</h4>--}}
{{--                                                        <p>Palestine</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="rate-comp ml-auto">--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <span>4.8</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="review-box">--}}
{{--                                            <div class="head d-flex">--}}
{{--                                                <div class="review-author media align-items-center">--}}
{{--                                                    <figure>--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-2.png') }}" class="author-img" alt="">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">--}}
{{--                                                    </figure>--}}
{{--                                                    <div class="media-body">--}}
{{--                                                        <h4>Carolien Bloeme</h4>--}}
{{--                                                        <p>England</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="rate-comp ml-auto">--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <span>4.8</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="review-box">--}}
{{--                                            <div class="head d-flex">--}}
{{--                                                <div class="review-author media align-items-center">--}}
{{--                                                    <figure>--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/u-3.png') }}" class="author-img" alt="">--}}
{{--                                                        <img src="{{ asset('assets/site/images/services/england-flag.png') }}" class="author-flag" alt="">--}}
{{--                                                    </figure>--}}
{{--                                                    <div class="media-body">--}}
{{--                                                        <h4>Alicia Puma</h4>--}}
{{--                                                        <p>England</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="rate-comp ml-auto">--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <i class="fas fa-star active"></i>--}}
{{--                                                    <span>4.8</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                Just ok. I mean it was inexpensive so I wasn’t expecting much, but there just didn’t seem to be much effort or skill involved. You’re mostly just paying for the ability to access 3 images from their stock image collection so you can manipulate it yourself.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="btn review-see-more btn-block btn-lg">See More</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </section>
                        <!-- user-services-section -->
                    </div>
                </div>
            </div>
        </section>
        <!-- freelancer-user-profile-page -->
    </div>
     <!-- send-message modal -->
     <div class="modal fade custom-modal send-message-modal" id="sendMessageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <header class="head d-flex justify-content-between">
                    <h3>{{__('site.contact_seller')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </header>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details">
                                <div class="user-box">
                                    <div class="user media">
                                        <figure>
                                            @if(auth()->check() && auth()->user()->avatar_full_path)
                                                <img src="{{auth()->user()->avatar_full_path}}" alt="">
                                            @else
                                                <img src="{{ asset('assets/site/images/user.png') }}" alt="">
                                            @endif
                                            {{-- <span></span> --}}
                                        </figure>
                                        <div class="media-body">
                                            <h4>{{ $user->name }}</h4>
                                            {{-- <p>Online</p> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="times">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="time">
                                                    <label>Local Time</label>
                                                    <p>Mon 18:02</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="time">
                                                    <label>Avg. Rspns</label>
                                                    <p>Mon 18:02</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="includes-box">
                                    <p>{{ __('site.Service_information')}}</p>
                                    <ol class="includes d-flex flex-wrap">
                                        <li>{{__('site.Description_service') }}</li>
                                        <li>{{__('site.Specific_information')}}</li>
                                        <li>{{__('site.Related_files')}}</li>
                                        <li>{{ __('site.budget')}}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="/user/conversation/send-message"  method="POST" nctype="multipart/form-data" id="formSendMassege" >
                                @csrf
                                <div class="message-wrapper d-flex flex-column ">
                                    <input type="hidden" id="service_provider_id" name="service_provider_id" value="{{$user->id}}">
                                    <textarea name="message" class="form-control" placeholder="{{__('site.Write_your_message')}}"></textarea>
                                    {{-- <div class="attachments d-flex align-items-center flex-wrap">
                                        <label>المرفقات:</label>
                                        <div class="attachment">
                                            <i class="fas fa-paperclip"></i>
                                            <span>image.png</span>
                                            <a href="">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                        <div class="attachment">
                                            <i class="fas fa-paperclip"></i>
                                            <span>File.docx</span>
                                            <a href="">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                    <div class="message-controls d-flex align-items-center">
                                        <!--<p class="counter">-->
                                        <!--    <span class="current">87</span>-->
                                        <!--    <span class="total">/ 2500</span>-->
                                        <!--</p>-->
                                        <button type="button" class="attachment-btn"><i class="fas fa-paperclip"></i></button>
                                        <button type="submit" class="btn btn-yallow" id="btnSendMassage">{{__('site.send')}}</button>

                                    </div>
                                </div>
                            </form>
                            <div id="alertMessege">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- send-message modal -->


@endsection
