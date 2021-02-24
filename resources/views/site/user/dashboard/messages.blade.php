@extends('site.user.dashboard.layout.main')

@section('css')
@endsection

@section('js')
    <script>
        $(document).ready(function() {

        });
        $(document).on('click','.messages-side-menu .conv-item',function(e){
            e.preventDefault();
            $('.messages-side-menu .conv-item').removeClass('active');
            $(this).removeClass('seen unseen');
            $(this).addClass('active');
            $(this).find('.unseen').remove();
            $(this).find('.seen').remove();
            $(this).find('.badge').remove();
        });
    </script>
@endsection

@section('content')
    <section class="main-page-content flex-grow-1">
        <!-- header -->
        <header class="dashboard-header d-flex align-items-center justify-content-between">
            <div class="title">
<<<<<<< HEAD
                <h3>Messages</h3>
                <p>
                    Hi, Emilee welcome back
=======
                <h3>{{__('site.Messages')}}</h3>
                <p>
                    @lang('site.welcome'), {{ auth()->user()->name }} @lang('site.welcome_back')
>>>>>>> ab56b91f26f3477c1fafa8dd53d46b7d37089cec
                </p>
            </div>
            <div class="page-header-btns">
                <a href="" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17.001" viewBox="0 0 17 17.001">
                        <path class="a"
                              d="M15.885,16.808l-3.344-3.343a7.626,7.626,0,1,1,.924-.924l3.343,3.344a.652.652,0,0,1,0,.923.65.65,0,0,1-.923,0ZM1.308,7.628A6.321,6.321,0,1,0,7.628,1.308,6.328,6.328,0,0,0,1.308,7.628Z" fill="currentcolor" />
                    </svg>
                </a>
                <a href="" class="btn notify-spot">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17.466" height="20.396" viewBox="0 0 17.466 20.396">
                        <g transform="translate(0)">
                            <g transform="translate(0 0)">
                                <path class="a"
                                      d="M5.1,17.411H.957c-.022,0-.044.008-.067.01a.756.756,0,0,1-.825-.667A10.551,10.551,0,0,1,0,15.611V11.363a8.953,8.953,0,0,1,8.009-9.2V.746a.747.747,0,0,1,1.493,0v1.41a8.4,8.4,0,0,1,5.422,2.7,9.476,9.476,0,0,1,2.537,6.507V15.6a10.55,10.55,0,0,1-.059,1.144.753.753,0,0,1-.169.394l-.007.008h0a.744.744,0,0,1-.569.264H12.416a3.732,3.732,0,0,1-7.313,0ZM8.76,18.9a2.24,2.24,0,0,0,2.112-1.492H6.649A2.24,2.24,0,0,0,8.76,18.9Zm7.2-2.984c.007-.107.012-.216.012-.328V11.363A7.959,7.959,0,0,0,13.834,5.87,6.963,6.963,0,0,0,8.76,3.612a7.511,7.511,0,0,0-7.213,7.751v4.557Z" fill="currentcolor" />
                            </g>
                        </g>
                    </svg>
                </a>
                <a href="" class="btn main-menu-toggle" id="main-menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
        </header>

        <!-- messages-section -->
        <div class="messages-section">
            <div class="wrapper d-flex">
                <div class="messages-side-menu">
<<<<<<< HEAD
                <a href="" class="btn message-menu-toggle" id="">
                    <i class="fas fa-align-left"></i>
                </a>
                    <div class="messages-side-content">
                        <header class="messages-side-header d-flex align-items-center">
                            <h3>All Conversations </h3>
=======
                    <div class="messages-side-content">
                        <header class="messages-side-header d-flex align-items-center">
                            <h3>{{__('site.All_Conversations')}}</h3>
>>>>>>> ab56b91f26f3477c1fafa8dd53d46b7d37089cec
                            <i class="fas fa-chevron-down"></i>
                        </header>
                        <div class="conversations">
                            <div class="conv-item media unseen">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Siri Jakobsson</h4>
                                    <p class="text">Thanks for your kind words, I’m very excited to start on. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media active">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14.628" height="16" viewBox="0 0 14.628 16">
                                        <g id="Group_12" data-name="Group 12" transform="translate(-365 -373)">
                                            <g id="Oval_Copy_3" data-name="Oval Copy 3" transform="translate(365 376)" fill="#818291" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                                <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                                <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                            </g>
                                            <g id="zz" transform="translate(373.258 374)" fill="#818291" stroke-linejoin="round" stroke-miterlimit="10">
                                                <path d="M 5.869999885559082 7.297463893890381 L 5.369999885559082 7.297463893890381 L -5.722045770539808e-08 7.297463893890381 L -0.5000000596046448 7.297463893890381 L -0.5000000596046448 6.797463893890381 L -0.5000000596046448 5.628304004669189 L -0.5000000596046448 5.467004299163818 L -0.4057400524616241 5.336113929748535 L 1.892305850982666 2.144984006881714 L 0.1359499394893646 2.144984006881714 L -0.3640500605106354 2.144984006881714 L -0.3640500605106354 1.644984126091003 L -0.3640500605106354 4.09271251555765e-06 L -0.3640500605106354 -0.4999959170818329 L 0.1359499394893646 -0.4999959170818329 L 5.234049797058105 -0.4999959170818329 L 5.734049797058105 -0.4999959170818329 L 5.734049797058105 4.09271251555765e-06 L 5.734049797058105 1.169164061546326 L 5.734049797058105 1.331084132194519 L 5.639130115509033 1.462264060974121 L 3.330847263336182 4.652483940124512 L 5.369999885559082 4.652483940124512 L 5.869999885559082 4.652483940124512 L 5.869999885559082 5.152483940124512 L 5.869999885559082 6.797463893890381 L 5.869999885559082 7.297463893890381 Z" stroke="none"/>
                                                <path d="M 5.369999885559082 6.797463893890381 L 5.369999885559082 5.152483940124512 L 2.351919889450073 5.152483940124512 L 5.234049797058105 1.169164061546326 L 5.234049797058105 4.09271251555765e-06 L 0.1359499394893646 4.09271251555765e-06 L 0.1359499394893646 1.644984126091003 L 2.868530035018921 1.644984126091003 L -5.722045770539808e-08 5.628304004669189 L -5.722045770539808e-08 6.797463893890381 L 5.369999885559082 6.797463893890381 M 5.369999885559082 7.797463893890381 L -5.722045770539808e-08 7.797463893890381 C -0.552280068397522 7.797463893890381 -1 7.349744319915771 -1 6.797463893890381 L -1 5.628304004669189 C -1 5.418564319610596 -0.9340500831604004 5.214124202728271 -0.8114800453186035 5.043923854827881 L 0.9160817265510559 2.644984006881714 L 0.1359499394893646 2.644984006881714 C -0.4163300693035126 2.644984006881714 -0.864050030708313 2.197264194488525 -0.864050030708313 1.644984126091003 L -0.864050030708313 4.09271251555765e-06 C -0.864050030708313 -0.5522758960723877 -0.4163300693035126 -0.9999958872795105 0.1359499394893646 -0.9999958872795105 L 5.234049797058105 -0.9999958872795105 C 5.786329746246338 -0.9999958872795105 6.234049797058105 -0.5522758960723877 6.234049797058105 4.09271251555765e-06 L 6.234049797058105 1.169164061546326 C 6.234049797058105 1.379674077033997 6.167619705200195 1.584814071655273 6.044219970703125 1.755364060401917 L 4.309784412384033 4.152483940124512 L 5.369999885559082 4.152483940124512 C 5.922279834747314 4.152483940124512 6.369999885559082 4.600203990936279 6.369999885559082 5.152483940124512 L 6.369999885559082 6.797463893890381 C 6.369999885559082 7.349744319915771 5.922279834747314 7.797463893890381 5.369999885559082 7.797463893890381 Z" stroke="none" fill="#fff"/>
                                            </g>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Victor Roberts</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media seen">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Njimoluh Ebua</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">

                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Arina Belomestnykh</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <span class="badge">3</span>
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Arina Belomestnykh</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Arina Belomestnykh</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <span class="badge">3</span>
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                            <div class="conv-item media">
                                <figure>
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="img-fluid">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                        <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                            <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                            <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                        </g>
                                    </svg>
                                </figure>
                                <div class="media-body">
                                    <h4>Arina Belomestnykh</h4>
                                    <p class="text">I’d like to officially welcome you to our design team. . .</p>
                                    <p class="date">1 WEEK AGO</p>
                                </div>
                                <div class="status-bar">
                                    <i class="fas fa-check-double seen"></i>
                                    <i class="fas fa-check-double unseen"></i>
                                    <i class="fas fa-chevron-right open-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="btn message-menu-toggle" id="message-menu-toggle">
                    <i class="fas fa-align-left"></i>
                </a>
                <div class="messages-body d-flex flex-column">
                    <div class="messages-body-content">
                        <div class="message-item">
                            <div class="ms-head d-flex align-items-center justify-content-between">
                                <div class="media">
                                    <img src="{{ asset('assets/site/images/u-1.png') }}" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Victor Roberts</h5>
                                    </div>
                                </div>
                                <p class="date">9:52 AM</p>
                            </div>
                            <div class="ms-contnet">
                                Hi Justin! We just wanted to welcome you to.
                            </div>
                        </div>
                        <div class="message-respond-item">
                            <p class="date">11:08 AM</p>
                            <div class="ms-contnet d-flex flex-row-reverse align-items-end">
                                <div class="content">
                                    Thank you, I’m so excited to join this amazing design team! I’m very grateful to have the opportunity to work on some
                                </div>
                                <i class="fas fa-check-double seen"></i>
                            </div>
                        </div>
                        <div class="message-item">
                            <div class="ms-head d-flex align-items-center justify-content-between">
                                <div class="media">
                                    <img src="{{ asset('assets/site/images/u-1.png') }}" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Victor Roberts</h5>
                                    </div>
                                </div>
                                <p class="date">9:52 AM</p>
                            </div>
                            <div class="ms-contnet">
                                Hi Justin! We just wanted to welcome you to.
                            </div>
                        </div>
                        <div class="message-respond-item">
                            <p class="date">11:08 AM</p>
                            <div class="ms-contnet d-flex flex-row-reverse align-items-end">
                                <div class="content">
                                    Thank you, I’m so excited to join this amazing design team! I’m very grateful to have the opportunity to work on some
                                </div>
                                <i class="fas fa-check-double seen"></i>
                            </div>
                        </div>
                        <div class="message-item">
                            <div class="ms-head d-flex align-items-center justify-content-between">
                                <div class="media">
                                    <img src="{{ asset('assets/site/images/u-1.png') }}" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Victor Roberts</h5>
                                    </div>
                                </div>
                                <p class="date">9:52 AM</p>
                            </div>
                            <div class="ms-contnet">
                                Hi Justin! We just wanted to welcome you to.
                            </div>
                        </div>
                        <div class="message-respond-item">
                            <p class="date">11:08 AM</p>
                            <div class="ms-contnet d-flex flex-row-reverse align-items-end">
                                <div class="content">
                                    Thank you, I’m so excited to join this amazing design team! I’m very grateful to have the opportunity to work on some
                                </div>
                                <i class="fas fa-check-double"></i>
                            </div>
                        </div>
                    </div>
                    <div class="messages-body-footer mt-auto d-flex align-items-center">
                        <textarea name="" class="form-control" placeholder="Type a message..."></textarea>
                        <div class="tools d-flex align-items-center">
                            <a href="">
                                <svg id="Picture_Icon" data-name="Picture Icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <rect id="Rectangle" width="16.875" height="16.875" rx="1.125" transform="translate(0.563 0.563)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <circle id="Oval" cx="2.25" cy="2.25" r="2.25" transform="translate(10.125 3.375)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <path id="Path" d="M0,.806A6.146,6.146,0,0,1,8.771,3.918" transform="translate(2.971 10.413)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <path id="Path-2" data-name="Path" d="M0,.871A3.337,3.337,0,0,1,4.388.777" transform="translate(10.786 11.818)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                </svg>
                            </a>
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.233" height="17.583" viewBox="0 0 18.233 17.583">
                                    <g id="Attachment_Icon" data-name="Attachment Icon" transform="translate(0 -0.121)">
                                        <path id="Path" d="M16.875,6.718,8.642,14.951a5.063,5.063,0,0,1-7.159-7.16L8.245,1.03A3.375,3.375,0,1,1,13.017,5.8L6.256,12.568a1.687,1.687,0,0,1-2.387-2.386l6.762-6.764" transform="translate(0.562 0.707)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    </g>
                                </svg>
                            </a>
                            <a href="">
                                <svg id="Emoji_Icon" data-name="Emoji Icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <circle id="Oval" cx="8.438" cy="8.438" r="8.438" transform="translate(0.563 0.563)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <path id="Path" d="M.562,0a.562.562,0,0,0-.53.75A5.625,5.625,0,0,0,5.337,4.5,5.625,5.625,0,0,0,10.642.75a.563.563,0,0,0-.53-.75Z" transform="translate(3.663 10.688)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <path id="Path-2" data-name="Path" d="M.375.094A.281.281,0,1,1,.094.375.281.281,0,0,1,.375.094" transform="translate(12 5.813)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                    <path id="Path-3" data-name="Path" d="M.375.094A.281.281,0,1,1,.094.375.281.281,0,0,1,.375.094" transform="translate(5.25 5.813)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
