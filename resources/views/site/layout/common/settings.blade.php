<div class="col-xl-4">
    <aside class="account-setting-sidebar">
        <h3 class="m-title">{{__('site.settings')}}</h3>
        <div class="links">
            <ul>
                <li>
                    <a href="{{url('/user/getprofileupdat')}}">
                        <div class="item d-flex align-items-center">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="19.5" viewBox="0 0 19.5 19.5">
                                                            <g id="user" transform="translate(-0.25 -0.25)">
                                                                <path id="Combined_Shape" data-name="Combined Shape" d="M18,18.75a7.26,7.26,0,0,0-7.25-7.25h-2A7.259,7.259,0,0,0,1.5,18.75a.75.75,0,1,1-1.5,0,8.773,8.773,0,0,1,6.3-8.4,5.754,5.754,0,1,1,6.884,0,8.774,8.774,0,0,1,6.312,8.4.75.75,0,1,1-1.5,0ZM5.5,5.75A4.25,4.25,0,1,0,9.75,1.5,4.255,4.255,0,0,0,5.5,5.75Z" transform="translate(0.25 0.25)" fill="currentcolor"/>
                                                            </g>
                                                        </svg>
                                                    </span>
                            <div class="content">
                                <h4>{{__('site.Account')}}</h4>
                                <p>{{__('site.Update your persoal info.')}}</p>
                            </div>
                            <i class="fas fa-chevron-right arrow"></i>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/user/me')}}" class="active">
                        <div class="item d-flex align-items-center">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.386" height="17.427" viewBox="0 0 17.386 17.427">
                                                            <g id="shield" transform="translate(-0.307 -0.269)">
                                                                <path id="Shape" d="M8.693,17.426C.1,17.426,0,8.861,0,8.774V.676A.679.679,0,0,1,.676,0H16.713a.679.679,0,0,1,.674.677v8.1C17.388,8.861,17.288,17.426,8.693,17.426ZM1.35,1.388V8.774a8.97,8.97,0,0,0,.962,3.762A6.338,6.338,0,0,0,4.5,14.976a7.628,7.628,0,0,0,4.2,1.1,7.634,7.634,0,0,0,4.2-1.1,6.332,6.332,0,0,0,2.187-2.44,8.981,8.981,0,0,0,.963-3.767V1.388Z" transform="translate(0.306 0.27)" fill="currentcolor"/>
                                                            </g>
                                                        </svg>
                                                    </span>
                            <div class="content">
                                <h4>{{__('site.Security')}}</h4>
                                <p>{{__('site.check your security and chage password')}}</p>
                            </div>
                            <i class="fas fa-chevron-right arrow"></i>
                        </div>
                    </a>
                </li>
                {{-- <li>
                    <a href="">
                        <div class="item d-flex align-items-center">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.555" height="20.5" viewBox="0 0 17.555 20.5">
                                                          <g id="bell" transform="translate(-0.195 -0.75)">
                                                            <path id="Path" d="M16.745,15.37h-.08a.74.74,0,0,1-.66-.83c0-.33.05-.65.05-1V9.29A8,8,0,0,0,13.9,3.77,7,7,0,0,0,8.8,1.5a7.55,7.55,0,0,0-7.25,7.79v5.26a.74.74,0,0,1-.66.83.76.76,0,0,1-.83-.67A10.65,10.65,0,0,1,0,13.56V9.29A9,9,0,0,1,8.8,0,8.45,8.45,0,0,1,15,2.75a9.53,9.53,0,0,1,2.55,6.54v4.26a10.65,10.65,0,0,1-.06,1.15.76.76,0,0,1-.75.67Z" transform="translate(0.195 2.88)"/>
                                                            <path id="Path-2" data-name="Path" d="M16.63,1.5H.75A.75.75,0,0,1,.75,0H16.63a.75.75,0,0,1,0,1.5Z" transform="translate(0.31 16.75)"/>
                                                            <path id="Path-3" data-name="Path" d="M.75,3.63A.75.75,0,0,1,0,2.88V.75a.75.75,0,0,1,1.5,0V2.88A.75.75,0,0,1,.75,3.63Z" transform="translate(8.25 0.75)"/>
                                                            <path id="Path-4" data-name="Path" d="M3.75,4.5A3.75,3.75,0,0,1,0,.75a.75.75,0,0,1,1.5,0A2.25,2.25,0,0,0,6,.75a.75.75,0,0,1,1.5,0A3.75,3.75,0,0,1,3.75,4.5Z" transform="translate(5.25 16.75)"/>
                                                          </g>
                                                        </svg>
                                                    </span>
                            <div class="content">
                                <h4>Notifications</h4>
                                <p>Control your notificatios</p>
                            </div>
                            <i class="fas fa-chevron-right arrow"></i>
                        </div>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="">
                        <div class="item d-flex align-items-center">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20.5" height="14.5" viewBox="0 0 20.5 14.5">
                                                          <path id="Combined_Shape_Copy" data-name="Combined Shape Copy" d="M-3.75,14.5A3.75,3.75,0,0,0,0,10.75v-7A3.75,3.75,0,0,0-3.75,0h-13A3.75,3.75,0,0,0-20.5,3.75v7.91a.75.75,0,0,0,.751.75.75.75,0,0,0,.75-.75V6.545H-1.5v4.2A2.25,2.25,0,0,1-3.75,13H-9.84a.751.751,0,0,0-.751.751.75.75,0,0,0,.751.75ZM-19,5.045V3.75A2.25,2.25,0,0,1-16.75,1.5h13A2.25,2.25,0,0,1-1.5,3.75v1.3Z" transform="translate(20.5)"/>
                                                        </svg>
                                                    </span>
                            <div class="content">
                                <h4>Paymet method</h4>
                                <p>Details of payments.</p>
                            </div>
                            <i class="fas fa-chevron-right arrow"></i>
                        </div>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="">
                        <div class="item d-flex align-items-center">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.92" height="16.92" viewBox="0 0 16.92 16.92">
                                                          <g id="graph" transform="translate(-0.54 -0.54)">
                                                            <path id="Shape" d="M13.854,16.92H3.067A3.072,3.072,0,0,1,0,13.85V3.067A3.071,3.071,0,0,1,3.067,0H13.854A3.071,3.071,0,0,1,16.92,3.067V13.85A3.072,3.072,0,0,1,13.854,16.92ZM3.067,1.229A1.843,1.843,0,0,0,1.226,3.067V13.854a1.844,1.844,0,0,0,1.842,1.841H13.85a1.844,1.844,0,0,0,1.841-1.841V3.067A1.842,1.842,0,0,0,13.85,1.229Z" transform="translate(0.54 0.54)"/>
                                                            <path id="Shape-2" data-name="Shape" d="M2.39,4.777A2.389,2.389,0,1,1,2.389,0a2.361,2.361,0,0,1,.919.186A2.388,2.388,0,0,1,2.39,4.777Zm0-3.542A1.162,1.162,0,1,0,3.552,2.4,1.18,1.18,0,0,0,2.387,1.235Z" transform="translate(9.884 3.264)"/>
                                                            <path id="Path" d="M.623,11.356a.581.581,0,0,1-.229-.041A.6.6,0,0,1,.058,10.5L4.2.385A.605.605,0,0,1,4.763,0a.614.614,0,0,1,.573.368L7.888,6.1l2.193-4.173a.614.614,0,1,1,1.08.573L8.379,7.789a.589.589,0,0,1-.556.327.622.622,0,0,1-.548-.368L4.763,2.176l-3.575,8.8a.605.605,0,0,1-.565.385Z" transform="translate(0.965 5.048)"/>
                                                          </g>
                                                        </svg>
                                                    </span>
                            <div class="content">
                                <h4>Balance</h4>
                                <p>your balance</p>
                            </div>
                            <i class="fas fa-chevron-right arrow"></i>
                        </div>
                    </a>
                </li> --}}
            </ul>
        </div>
    </aside>
</div>
