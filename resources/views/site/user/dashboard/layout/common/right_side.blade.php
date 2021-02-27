<aside class="dashboard-right-side">
    <div class="user-profile-box">
        <figure class="text-center">
            @if(auth()->check() && auth()->user()->avatar_full_path)
                <img src="{{auth()->user()->avatar_full_path}}" alt="" class="img-fluid">
            @else
                <img src="{{ asset('assets/site/images/user.png') }}" alt="" class="img-fluid">
            @endif
        </figure>
        <h3>{{ auth()->user()->name }}</h3>
        <p class="brief">{{ auth()->user()->about_me }}</p>
        <div class="actions text-center">
            <a href="{{ url('user/profile') }}" class="btn btn-outline-darkblue">@lang('site.show_profile')</a>
        </div>
        <div class="summary">
            <div class="item d-flex align-items-center justify-content-between">
                <label>{{__('site.Earned')}}</label>
                <p>{{ number_format($clientsOrdersTotalPaidCount , 2, '.', '') }} $</p>
            </div>
            {{-- <div class="item d-flex align-items-center justify-content-between">
                <label>Response Time</label>
                <p class="yallow">1 hour</p>
            </div> --}}
        </div>
    </div>
    {{-- <div class="user-statistics-box">
        <div class="item">
            <div class="title">
                <h5>@if($allClientsOrdersCount == 0) 0 @else {{ number_format($currentClientsOrdersCount / $allClientsOrdersCount * 100 , 2, '.', '') }}@endif%</h5>
                <p>@lang('site.orders') @lang('site.current_order')</p>
            </div>
            <div class="statistic">
                <div class="period">

                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$currentClientsOrdersCount / $allClientsOrdersCount * 100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="title">
                <h5>@if($allClientsOrdersCount == 0) 0 @else{{ number_format($deliveredClientsOrdersCount / $allClientsOrdersCount * 100 , 2, '.', '') }}@endif%</h5>
                <p>@lang('site.orders') @lang('site.delivered_order')</p>
            </div>
            <div class="statistic">
                <div class="period">
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$deliveredClientsOrdersCount / $allClientsOrdersCount * 100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="title">
                <h5>@if($allClientsOrdersCount == 0) 0 @else{{ number_format($cancelledClientsOrdersCount / $allClientsOrdersCount * 100 , 2, '.', '') }}@endif%</h5>
                <p>@lang('site.orders') @lang('site.cancelled_order')</p>
            </div>
            <div class="statistic">
                <div class="period">
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$cancelledClientsOrdersCount / $allClientsOrdersCount * 100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="help-box">
        <figure>
            <img src="{{ asset('assets/site/images/dashboard/serv-question.png') }}" class="img-fluid">
        </figure>
        <h3>@lang('site.need_help')</h3>
        <p>@lang('site.need_help_text').</p>
        <div class="actions">
            <a href="{{ url('contactus') }}" class="btn btn-yallow">@lang('site.contact_seller')</a>
        </div>
    </div>
</aside>
