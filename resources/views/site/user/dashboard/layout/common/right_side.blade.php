<aside class="dashboard-right-side">
    <div class="user-profile-box">
        <figure class="text-center">
            <img src="{{ asset('assets/site/images/user.png') }}" class="img-fluid">
        </figure>
        <h3>{{ auth()->user()->name }}</h3>
        <p class="brief">{{ auth()->user()->about_me }}</p>
        <div class="actions text-center">
            <a href="{{ url('user/profile') }}" class="btn btn-outline-darkblue">@lang('site.show_profile')</a>
        </div>
        <div class="summary">
            <div class="item d-flex align-items-center justify-content-between">
                <label>Earned in November</label>
                <p>324 SAR</p>
            </div>
            <div class="item d-flex align-items-center justify-content-between">
                <label>Response Time</label>
                <p class="yallow">1 hour</p>
            </div>
        </div>
    </div>
    <div class="user-statistics-box">
        <div class="item">
            <div class="title">
                <h5>55%</h5>
                <p>Response Rate</p>
            </div>
            <div class="statistic">
                <div class="period">
                    <span>13 Jun - 14 Aug</span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="title">
                <h5>90%</h5>
                <p>Delivered on Time</p>
            </div>
            <div class="statistic">
                <div class="period">
                    <span>13 Jun - 14 Aug</span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="title">
                <h5>30%</h5>
                <p>Order Completion</p>
            </div>
            <div class="statistic">
                <div class="period">
                    <span>13 Jun - 14 Aug</span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="help-box">
        <figure>
            <img src="{{ asset('assets/site/images/dashboard/serv-question.png') }}" class="img-fluid">
        </figure>
        <h3>@lang('site.need_help')</h3>
        <p>@lang('site.need_help_text').</p>
        <div class="actions">
            <a href="{{ url('contact') }}" class="btn btn-yallow">@lang('site.contact_seller')</a>
        </div>
    </div>
</aside>
