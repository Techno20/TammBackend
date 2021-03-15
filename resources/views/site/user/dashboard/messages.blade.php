@extends('site.user.dashboard.layout.main')

@section('css')
    <style>
        .another-content
        {
            display: inline-block;
            padding: 8px;
            border-radius: 20px;
            color: #51606D;
            font-size: 14px;
            font-family: 'font500',sans-serif;
            border: 1px solid #E1E1E1;
            text-align: start;
            max-width: 70%;
            float: left;
        }

        .ms-contnet-another
        {
            margin-right: 30px;
            display: inline-block;
            padding: 8px;
            border-radius: 20px;
            background-color: #FCF8EF;
            font-size: 14px;
            color: #242851;
        }

    </style>
@endsection



@section('content')
    <section class="main-page-content flex-grow-1">
        <!-- header -->
        <header class="dashboard-header d-flex align-items-center justify-content-between">
            <div class="title">
                <h3>{{__('site.Messages')}}</h3>
                <p>
                    @lang('site.welcome'), {{ auth()->user()->name }} @lang('site.welcome_back')
                </p>
            </div>
            @include('site.user.dashboard.includes.notifications')
        </header>

        <div class="messages-side-overlay"></div>

        <!-- messages-section -->
        <div class="messages-section">
            <div class="wrapper d-flex">
                <div class="messages-side-menu">
                    <div class="messages-side-content">

                        <header class="messages-side-header d-flex align-items-center">
                            <h3>{{__('site.All_Conversations')}}</h3>
                            <i class="fas fa-chevron-down"></i>
                        </header>
                        <div class="conversations">
                            <input type="hidden" id="tempIdConversations">
                            <input type="hidden" id="idMyUSer" value="{{auth()->user()->id}}">
                            @foreach ($conversations as $Conversations)
                            {{-- {{$Conversations->id}} --}}
                                <div class="conv-item media unseen" id="{{$Conversations->id}}" onclick="getMassegeChats('{{$Conversations->id}}')">

                                    <figure>
                                        @if ($Conversations->recipient->id == auth()->user()->id)
                                            <img src="{{ $Conversations->sender ? $Conversations->sender->avatar_full_path : asset('/assets/site/images/user.png') }}" class="img-fluid">
                                        @else
                                            <img src="{{ $Conversations->recipient ? $Conversations->recipient->avatar_full_path : asset('/assets/site/images/user.png') }}" class="img-fluid">
                                        @endif
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                            <g id="Oval" fill="#00db51" stroke="#fff" stroke-miterlimit="10" stroke-width="2">
                                                <circle cx="6.5" cy="6.5" r="6.5" stroke="none"/>
                                                <circle cx="6.5" cy="6.5" r="5.5" fill="none"/>
                                            </g>
                                        </svg> --}}
                                    </figure>
                                    <div class="media-body">


                                        @if ($Conversations->recipient && $Conversations->recipient->id == auth()->user()->id)
                                            <h4>{{$Conversations->sender ? $Conversations->sender->name : ''}}</h4>
                                            <p class="text">{{$Conversations->sender ? $Conversations->sender->email : ''}}</p>
                                        @else
                                            <h4>{{$Conversations->recipient ? $Conversations->recipient->name : ''}}</h4>
                                            <p class="text">{{$Conversations->recipient ? $Conversations->recipient->email : ''}}</p>
                                        @endif
                                        {{-- <p class="date">1 WEEK AGO</p> --}}
                                    </div>
                                    <div class="status-bar">
                                        <i class="fas fa-check-double seen"></i>
                                        <i class="fas fa-check-double unseen"></i>
                                        <i class="fas fa-chevron-right open-group"></i>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="conv-item media unseen">
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
                            </div> --}}
                        </div>
                    </div>
                </div>
                <a href="" class="btn message-menu-toggle" id="message-menu-toggle">
                    <i class="fas fa-align-left"></i>
                </a>
                <div class="messages-body d-flex flex-column">
                    <div class="messages-body-content" id="messages_body_content">


                        {{-- <div class="message-item">
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
                        </div> --}}

                        {{-- <div class="message-item">
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
                        </div> --}}
                    </div>

                    <div class="messages-body-footer mt-auto d-flex align-items-center">
                        <form action="" method="POST" id="formReplayMessege" enctype="multipart/form-data">
                            @csrf
                            <textarea class="form-control" id="txtAeraMessage" name="message" placeholder="Type a message..."></textarea>
                            <input type="file" name="attachment" id="attachment" style="display: none;">
                            <div class="tools d-flex align-items-center">
                                <a href="" id="Attachment_Icon_action">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.233" height="17.583" viewBox="0 0 18.233 17.583">
                                        <g id="Attachment_Icon" data-name="Attachment Icon" transform="translate(0 -0.121)">
                                            <path id="Path" d="M16.875,6.718,8.642,14.951a5.063,5.063,0,0,1-7.159-7.16L8.245,1.03A3.375,3.375,0,1,1,13.017,5.8L6.256,12.568a1.687,1.687,0,0,1-2.387-2.386l6.762-6.764" transform="translate(0.562 0.707)" fill="none" stroke="#9fa1b6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.125"/>
                                        </g>
                                    </svg>
                                </a>
                                <input type="submit" id="btnReplayMessege" class="btn btn-yallow" value="ارسال">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
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

    <script>
        $(document).ready(function () {
            $("#Attachment_Icon_action").click(function (event) {
                event.preventDefault();
                $("#attachment").click();
            });
        });
    </script>

@endsection
