@extends('site.user.dashboard.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <section class="main-page-content flex-grow-1">
        <!-- header -->
        <header class="dashboard-header d-flex align-items-center justify-content-between">
            <div class="title">
                <h3>Buyers</h3>
                <p>
                    Hi, Emilee welcome back
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


        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between">
                <h3 class="title">MY BUYERS</h3>
            </header>
            <div class="sec-content">
                <div class="table-responsive">
                    <table class="table table-borderless cs-table-2">
                        <thead>
                        <tr>
                            <th>Buyer Name</th>
                            <th>Completed Orders</th>
                            <th>amount spent </th>
                            <th>last order </th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="media circle-img align-items-center">
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="">
                                    <div class="media-body">
                                        <h3>Boris Ukhtomsky</h3>
                                    </div>
                                </div>
                            </td>
                            <td>22 Jun</td>
                            <td>23 Jun</td>
                            <td>$12.00</td>
                            <td>
                                <a href="" class="btn btn-gray message-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.899" height="18.958" viewBox="0 0 18.899 18.958">
                                        <g id="chat-code" transform="translate(-0.922 -0.042)">
                                            <path id="Combined_Shape" data-name="Combined Shape" d="M1.531,18.958H1.494A1.494,1.494,0,0,1,.131,16.853L1.6,13.571a9.195,9.195,0,1,1,9.773,4.7,10.06,10.06,0,0,1-1.684.148A9.215,9.215,0,0,1,5.8,17.529L2.025,18.874a1.383,1.383,0,0,1-.472.084Zm.7-11.578a7.7,7.7,0,0,0,.842,5.69.8.8,0,0,1,.117.836L1.688,17.326l3.863-1.379a.789.789,0,0,1,.815.111l.02.016a7.613,7.613,0,1,0,4-14.451c-.251-.024-.5-.037-.748-.037A7.631,7.631,0,0,0,2.236,7.379Zm3.842,3.329a.75.75,0,0,1-.1-1.493l.1-.007h5a.75.75,0,0,1,.1,1.493l-.1.007Zm0-3a.75.75,0,0,1-.1-1.493l.1-.006h8a.75.75,0,0,1,.1,1.493l-.1.006Z" transform="translate(0.922 0.042)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media circle-img align-items-center">
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="">
                                    <div class="media-body">
                                        <h3>Boris Ukhtomsky</h3>
                                    </div>
                                </div>
                            </td>
                            <td>22 Jun</td>
                            <td>23 Jun</td>
                            <td>$12.00</td>
                            <td>
                                <a href="" class="btn btn-gray message-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.899" height="18.958" viewBox="0 0 18.899 18.958">
                                        <g id="chat-code" transform="translate(-0.922 -0.042)">
                                            <path id="Combined_Shape" data-name="Combined Shape" d="M1.531,18.958H1.494A1.494,1.494,0,0,1,.131,16.853L1.6,13.571a9.195,9.195,0,1,1,9.773,4.7,10.06,10.06,0,0,1-1.684.148A9.215,9.215,0,0,1,5.8,17.529L2.025,18.874a1.383,1.383,0,0,1-.472.084Zm.7-11.578a7.7,7.7,0,0,0,.842,5.69.8.8,0,0,1,.117.836L1.688,17.326l3.863-1.379a.789.789,0,0,1,.815.111l.02.016a7.613,7.613,0,1,0,4-14.451c-.251-.024-.5-.037-.748-.037A7.631,7.631,0,0,0,2.236,7.379Zm3.842,3.329a.75.75,0,0,1-.1-1.493l.1-.007h5a.75.75,0,0,1,.1,1.493l-.1.007Zm0-3a.75.75,0,0,1-.1-1.493l.1-.006h8a.75.75,0,0,1,.1,1.493l-.1.006Z" transform="translate(0.922 0.042)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media circle-img align-items-center">
                                    <img src="{{ asset('assets/site/images/u-1.png') }}" class="">
                                    <div class="media-body">
                                        <h3>Kiandra Lowe</h3>
                                    </div>
                                </div>
                            </td>
                            <td>22 Jun</td>
                            <td>23 Jun</td>
                            <td>$12.00</td>
                            <td>
                                <a href="" class="btn btn-gray message-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.899" height="18.958" viewBox="0 0 18.899 18.958">
                                        <g id="chat-code" transform="translate(-0.922 -0.042)">
                                            <path id="Combined_Shape" data-name="Combined Shape" d="M1.531,18.958H1.494A1.494,1.494,0,0,1,.131,16.853L1.6,13.571a9.195,9.195,0,1,1,9.773,4.7,10.06,10.06,0,0,1-1.684.148A9.215,9.215,0,0,1,5.8,17.529L2.025,18.874a1.383,1.383,0,0,1-.472.084Zm.7-11.578a7.7,7.7,0,0,0,.842,5.69.8.8,0,0,1,.117.836L1.688,17.326l3.863-1.379a.789.789,0,0,1,.815.111l.02.016a7.613,7.613,0,1,0,4-14.451c-.251-.024-.5-.037-.748-.037A7.631,7.631,0,0,0,2.236,7.379Zm3.842,3.329a.75.75,0,0,1-.1-1.493l.1-.007h5a.75.75,0,0,1,.1,1.493l-.1.007Zm0-3a.75.75,0,0,1-.1-1.493l.1-.006h8a.75.75,0,0,1,.1,1.493l-.1.006Z" transform="translate(0.922 0.042)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media circle-img align-items-center">
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="">
                                    <div class="media-body">
                                        <h3>Boris Ukhtomsky</h3>
                                    </div>
                                </div>
                            </td>
                            <td>22 Jun</td>
                            <td>23 Jun</td>
                            <td>$12.00</td>
                            <td>
                                <a href="" class="btn btn-gray message-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.899" height="18.958" viewBox="0 0 18.899 18.958">
                                        <g id="chat-code" transform="translate(-0.922 -0.042)">
                                            <path id="Combined_Shape" data-name="Combined Shape" d="M1.531,18.958H1.494A1.494,1.494,0,0,1,.131,16.853L1.6,13.571a9.195,9.195,0,1,1,9.773,4.7,10.06,10.06,0,0,1-1.684.148A9.215,9.215,0,0,1,5.8,17.529L2.025,18.874a1.383,1.383,0,0,1-.472.084Zm.7-11.578a7.7,7.7,0,0,0,.842,5.69.8.8,0,0,1,.117.836L1.688,17.326l3.863-1.379a.789.789,0,0,1,.815.111l.02.016a7.613,7.613,0,1,0,4-14.451c-.251-.024-.5-.037-.748-.037A7.631,7.631,0,0,0,2.236,7.379Zm3.842,3.329a.75.75,0,0,1-.1-1.493l.1-.007h5a.75.75,0,0,1,.1,1.493l-.1.007Zm0-3a.75.75,0,0,1-.1-1.493l.1-.006h8a.75.75,0,0,1,.1,1.493l-.1.006Z" transform="translate(0.922 0.042)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media circle-img align-items-center">
                                    <img src="{{ asset('assets/site/images/u-2.png') }}" class="">
                                    <div class="media-body">
                                        <h3>Boris Ukhtomsky</h3>
                                    </div>
                                </div>
                            </td>
                            <td>22 Jun</td>
                            <td>23 Jun</td>
                            <td>$12.00</td>
                            <td>
                                <a href="" class="btn btn-gray message-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.899" height="18.958" viewBox="0 0 18.899 18.958">
                                        <g id="chat-code" transform="translate(-0.922 -0.042)">
                                            <path id="Combined_Shape" data-name="Combined Shape" d="M1.531,18.958H1.494A1.494,1.494,0,0,1,.131,16.853L1.6,13.571a9.195,9.195,0,1,1,9.773,4.7,10.06,10.06,0,0,1-1.684.148A9.215,9.215,0,0,1,5.8,17.529L2.025,18.874a1.383,1.383,0,0,1-.472.084Zm.7-11.578a7.7,7.7,0,0,0,.842,5.69.8.8,0,0,1,.117.836L1.688,17.326l3.863-1.379a.789.789,0,0,1,.815.111l.02.016a7.613,7.613,0,1,0,4-14.451c-.251-.024-.5-.037-.748-.037A7.631,7.631,0,0,0,2.236,7.379Zm3.842,3.329a.75.75,0,0,1-.1-1.493l.1-.007h5a.75.75,0,0,1,.1,1.493l-.1.007Zm0-3a.75.75,0,0,1-.1-1.493l.1-.006h8a.75.75,0,0,1,.1,1.493l-.1.006Z" transform="translate(0.922 0.042)" fill="currentcolor"/>
                                        </g>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </section>
@endsection
