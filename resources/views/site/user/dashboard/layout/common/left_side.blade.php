<aside class="left-side-menu">
    <div class="side-content d-flex flex-column">
        <a href="{{ url('/') }}" class="side-brand">
            @if(app()->getLocale() == 'ar')
                <img src="{{ asset('assets/shared/img/logo.svg') }}" alt="">
            @else
                <img src="{{ asset('assets/site/images/logo.svg') }}" alt="">
            @endif
        </a>
        <div class="user-info-side media align-items-center">
            <figure>
                <img src="{{ asset('assets/site/images/user.png') }}" alt="" />
            </figure>
            <div class="media-body">
                <h5>@lang('site.welcome'), <span>{{ auth()->user()->name }}</span></h5>
                <p>{{ auth()->user()->email }}</p>
            </div>
        </div>
        <nav class="left-side-nav">
            <ul class="list-unstyled">
                <li class="nav-item">
                    <a href="{{ url('user/dashboard') }}" class="nav-link {{ str_contains(request()->url(), '/user/dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.591" height="11.93" viewBox="0 0 17.591 11.93">
                            <g transform="translate(-0.204 -1.504)">
                                <g transform="translate(0 0.866)">
                                    <path class="side-icon"
                                          d="M.861,11.911a.613.613,0,0,1-.452-.464,8.8,8.8,0,1,1,16.772,0,.6.6,0,0,1-.58.392.55.55,0,0,1-.188,0H1.329a.611.611,0,0,1-.468.072Zm15.286-1.3a7.568,7.568,0,1,0-14.7,0ZM8.362,9.205a.614.614,0,0,1,0-.868l3.273-3.272a.613.613,0,0,1,.867.842L9.229,9.18a.606.606,0,0,1-.434.205h0A.6.6,0,0,1,8.362,9.205Z"
                                          transform="translate(0.204 0.638)" />
                                </g>
                            </g>
                        </svg>

                        <span>@lang('site.dashboard')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user/order/list/seller') }}" class="nav-link {{ str_contains(request()->url(), '/user/order/list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.558" height="17.246" viewBox="0 0 17.558 17.246">
                            <g transform="translate(-0.208 -0.377)">
                                <path class="a"
                                      d="M6.068,7.795H1.726a1.72,1.72,0,0,1-1.22-.508A1.738,1.738,0,0,1,0,6.056V1.737A1.729,1.729,0,0,1,1.737,0H6.058A1.729,1.729,0,0,1,7.794,1.737V6.056a1.738,1.738,0,0,1-.505,1.231A1.719,1.719,0,0,1,6.068,7.795ZM1.737,1.351a.386.386,0,0,0-.387.385v4.32a.388.388,0,0,0,.387.388H6.058a.388.388,0,0,0,.387-.388V1.735a.386.386,0,0,0-.387-.385Z"
                                      transform="translate(5.103 0.378)" />
                                <path class="a"
                                      d="M6.1,7.795H1.731A1.728,1.728,0,0,1,0,6.058V1.737A1.723,1.723,0,0,1,1.731,0H6.1A1.724,1.724,0,0,1,7.83,1.737v4.32A1.729,1.729,0,0,1,6.1,7.795ZM1.773,1.351a.387.387,0,0,0-.387.387v4.32a.387.387,0,0,0,.387.387h4.32a.387.387,0,0,0,.387-.387V1.737a.387.387,0,0,0-.387-.387Z"
                                      transform="translate(0.207 9.828)" />
                                <path class="a"
                                      d="M6.093,7.795H1.738A1.739,1.739,0,0,1,0,6.058V1.737A1.732,1.732,0,0,1,1.738,0H6.069A1.736,1.736,0,0,1,7.8,1.737v4.32A1.748,1.748,0,0,1,6.093,7.795ZM1.738,1.349a.388.388,0,0,0-.387.389v4.32a.387.387,0,0,0,.387.387h4.32a.393.393,0,0,0,.395-.387V1.737a.4.4,0,0,0-.395-.389Z"
                                      transform="translate(9.963 9.828)" />
                            </g>
                        </svg>

                        <span>@lang('site.orders')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user/service/list') }}" class="nav-link {{ str_contains(request()->url(), '/user/service/list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.558" height="17.246" viewBox="0 0 17.558 17.246">
                            <g transform="translate(-0.208 -0.377)">
                                <path class="a"
                                      d="M6.068,7.795H1.726a1.72,1.72,0,0,1-1.22-.508A1.738,1.738,0,0,1,0,6.056V1.737A1.729,1.729,0,0,1,1.737,0H6.058A1.729,1.729,0,0,1,7.794,1.737V6.056a1.738,1.738,0,0,1-.505,1.231A1.719,1.719,0,0,1,6.068,7.795ZM1.737,1.351a.386.386,0,0,0-.387.385v4.32a.388.388,0,0,0,.387.388H6.058a.388.388,0,0,0,.387-.388V1.735a.386.386,0,0,0-.387-.385Z"
                                      transform="translate(5.103 0.378)" />
                                <path class="a"
                                      d="M6.1,7.795H1.731A1.728,1.728,0,0,1,0,6.058V1.737A1.723,1.723,0,0,1,1.731,0H6.1A1.724,1.724,0,0,1,7.83,1.737v4.32A1.729,1.729,0,0,1,6.1,7.795ZM1.773,1.351a.387.387,0,0,0-.387.387v4.32a.387.387,0,0,0,.387.387h4.32a.387.387,0,0,0,.387-.387V1.737a.387.387,0,0,0-.387-.387Z"
                                      transform="translate(0.207 9.828)" />
                                <path class="a"
                                      d="M6.093,7.795H1.738A1.739,1.739,0,0,1,0,6.058V1.737A1.732,1.732,0,0,1,1.738,0H6.069A1.736,1.736,0,0,1,7.8,1.737v4.32A1.748,1.748,0,0,1,6.093,7.795ZM1.738,1.349a.388.388,0,0,0-.387.389v4.32a.387.387,0,0,0,.387.387h4.32a.393.393,0,0,0,.395-.387V1.737a.4.4,0,0,0-.395-.389Z"
                                      transform="translate(9.963 9.828)" />
                            </g>
                        </svg>

                        <span>@lang('site.services')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user/conversation/list') }}" class="nav-link {{ str_contains(request()->url(), '/user/conversation/list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.009" height="17.062" viewBox="0 0 17.009 17.062">
                            <g transform="translate(-0.83 -0.038)">
                                <path class="a"
                                      d="M1.378,17.062H1.346A1.344,1.344,0,0,1,.118,15.168l1.321-2.955a8.275,8.275,0,1,1,8.8,4.234,9.113,9.113,0,0,1-1.517.132,8.276,8.276,0,0,1-3.5-.8l-3.4,1.21a1.248,1.248,0,0,1-.429.076ZM2.012,6.641a6.925,6.925,0,0,0,.759,5.123.72.72,0,0,1,.1.751L1.519,15.593,5,14.352a.712.712,0,0,1,.734.1l.02.017a6.941,6.941,0,0,0,4.258.566A6.868,6.868,0,0,0,9.346,1.461q-.338-.033-.673-.033A6.868,6.868,0,0,0,2.012,6.641Zm3.458,3a.675.675,0,0,1-.092-1.344l.092-.006h4.5a.675.675,0,0,1,.092,1.344l-.092.006Zm0-2.7a.675.675,0,0,1-.092-1.344l.092-.006h7.2a.675.675,0,0,1,.092,1.344l-.092.006Z"
                                      transform="translate(0.83 0.038)" />
                            </g>
                        </svg>

                        <span>@lang('site.conversation') </span>

                        <dt>15</dt>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user/buyer/list') }}" class="nav-link {{ str_contains(request()->url(), '/user/buyer/list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.566" height="11.456" viewBox="0 0 17.566 11.456">
                            <g transform="translate(-0.205 0.001)">
                                <path class="a"
                                      d="M12.887,9.409H.615A.621.621,0,0,1,0,8.795V.613A.621.621,0,0,1,.615,0H12.887A.624.624,0,0,1,13.5.613V8.795A.616.616,0,0,1,12.887,9.409ZM1.226,1.228V8.181H12.273V1.228Z"
                                      transform="translate(2.25)" />
                                <path class="a"
                                      d="M16.977,3.373H.613A.614.614,0,0,1,.179,2.325L2.249.28a.614.614,0,1,1,.818.867l-.974,1H15.5l-.974-1A.614.614,0,1,1,15.34.28l2.045,2.045a.614.614,0,0,1-.409,1.047Z"
                                      transform="translate(0.205 8.082)" />
                            </g>
                        </svg>

                        <span>@lang('site.buyers')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('user/me') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.384" height="17.437" viewBox="0 0 17.384 17.437">
                            <g transform="translate(-0.307 -0.285)">
                                <path class="a"
                                      d="M8.691,17.436h0a2.2,2.2,0,0,1-1.708-.818L6.262,15.8a1.014,1.014,0,0,0-.769-.354l-.073,0-1.1.1c-.056,0-.117.007-.182.007a2.245,2.245,0,0,1-2.248-2.431l.089-1.137a1.036,1.036,0,0,0-.359-.818L.8,10.457a2.241,2.241,0,0,1,0-3.429l.819-.719a1.025,1.025,0,0,0,.344-.869l-.1-1.1A2.3,2.3,0,0,1,2.507,2.56,2.238,2.238,0,0,1,4.1,1.9c.058,0,.12,0,.185.008L5.42,2h.05a1,1,0,0,0,.769-.36L6.949.817A2.252,2.252,0,0,1,8.66,0,2.217,2.217,0,0,1,10.37.817l.719.819a1.037,1.037,0,0,0,.777.349c.03,0,.062,0,.1,0l1.1-.1c.075-.007.148-.011.218-.011a2.249,2.249,0,0,1,2.235,2.464l-.113,1.1a1.03,1.03,0,0,0,.359.819l.819.711a2.246,2.246,0,0,1,0,3.429l-.819.719a1.017,1.017,0,0,0-.344.868l.1,1.1a2.277,2.277,0,0,1-.645,1.776,2.225,2.225,0,0,1-1.588.661c-.059,0-.122,0-.189-.008l-1.136-.089H11.93a1.036,1.036,0,0,0-.783.36l-.711.818a2.248,2.248,0,0,1-1.711.818l-.034.008ZM5.5,14.22h0a2.249,2.249,0,0,1,1.71.818l.719.818a1.009,1.009,0,0,0,.769.359h.01l.028,0h.027a.97.97,0,0,0,.761-.37l.714-.818a2.237,2.237,0,0,1,1.736-.824c.054,0,.108,0,.161.006l1.1.081a1.054,1.054,0,0,0,.111.006.988.988,0,0,0,.707-.3,1.016,1.016,0,0,0,.294-.818l-.089-1.1a2.242,2.242,0,0,1,.819-1.9l.819-.719a1.023,1.023,0,0,0,.359-.779.994.994,0,0,0-.367-.818l-.819-.711a2.244,2.244,0,0,1-.819-1.9l.081-1.107a1.006,1.006,0,0,0-.3-.806,1.02,1.02,0,0,0-.711-.293c-.029,0-.061,0-.1,0l-1.1.089c-.055,0-.112.006-.168.006a2.211,2.211,0,0,1-1.729-.824l-.721-.819a1.016,1.016,0,0,0-.719-.3.979.979,0,0,0-.107.006H8.64a.969.969,0,0,0-.765.37l-.714.816a2.262,2.262,0,0,1-1.75.823c-.044,0-.092,0-.147,0l-1.1-.081a1.017,1.017,0,0,0-.109-.006,1,1,0,0,0-.709.3,1.016,1.016,0,0,0-.294.818l.089,1.1a2.223,2.223,0,0,1-.819,1.9L1.5,7.97a1.02,1.02,0,0,0-.359.776.988.988,0,0,0,.367.819l.819.711a2.255,2.255,0,0,1,.819,1.9l-.081,1.1a1.007,1.007,0,0,0,.3.806,1.023,1.023,0,0,0,.718.295.842.842,0,0,0,.09,0l1.1-.092L5.5,14.22Z"
                                      transform="translate(0.308 0.286)" />
                                <path class="a"
                                      d="M3.067,6.138a3.069,3.069,0,1,1,3.07-3.07A3.072,3.072,0,0,1,3.067,6.138Zm0-4.909A1.84,1.84,0,1,0,4.909,3.067,1.841,1.841,0,0,0,3.067,1.229Z"
                                      transform="translate(5.932 5.932)" />
                            </g>
                        </svg>

                        <span>@lang('site.settings')</span>
                        <span class="icon">
                                        <svg id="Group_8" data-name="Group 8" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                            <rect id="Rectangle_Copy_5" data-name="Rectangle Copy 5" width="22" height="22" rx="11" fill="#f9f9f9" />
                                            <g id="noun_External_Link_1383916" data-name="noun_External Link_1383916" transform="translate(6 6)">
                                                <path id="Combined_Shape" data-name="Combined Shape"
                                                      d="M1.537,9.5A1.538,1.538,0,0,1,0,8.083l0-.121V2.914A1.538,1.538,0,0,1,1.418,1.382l.12,0H4.291A.619.619,0,0,1,4.375,2.61l-.084.006H1.537a.3.3,0,0,0-.292.238l-.006.06V7.962a.3.3,0,0,0,.238.292l.06.006H6.585a.3.3,0,0,0,.293-.238l.006-.06V5.209a.619.619,0,0,1,1.233-.085l.006.085V7.962A1.537,1.537,0,0,1,6.706,9.495L6.585,9.5ZM3.394,6.106a.621.621,0,0,1-.06-.806l.06-.069L7.385,1.239H6.127A.62.62,0,0,1,5.513.7L5.507.619A.62.62,0,0,1,6.043.005L6.127,0H8.88a.619.619,0,0,1,.571.379h0l0,.011,0,0,0,.008,0,.007,0,.005,0,.01v0A.621.621,0,0,1,9.5.615V3.373a.62.62,0,0,1-1.234.084l-.005-.084V2.115L4.271,6.106a.62.62,0,0,1-.877,0Z"
                                                      fill="#9fa1b6" />
                                            </g>
                                        </svg>
                                    </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('user/logout') }}" class="nav-link">
                        <img src="{{ asset('assets/site/images/icons/signout.svg') }}" alt="">

                        <span>@lang('site.logout')</span>
                    </a>
                </li>


            </ul>
        </nav>

        <div class="promo-side">
            <img src="{{ asset('assets/site/images/dashboard/bottom.png') }}" alt="" title="" class="img-fluid" />

            <p>@lang('site.learn_more_about_tamm')</p>
            <a href="{{ url('/') }}" class="btn btn-yallow btn-block">@lang('site.go_now')</a>
        </div>
    </div>
</aside>