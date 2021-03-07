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
                <h3>My services</h3>
                <p>
                    Hi, Emilee welcome back
                </p>
            </div>
            <div class="page-header-btns">

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

            </div>
        </header>

        <!-- filter -->
        <section class="filter-cats-sec">
            <a href="" class="item active">ACTIVE(4)</a>
            <a href="" class="item">MISSING DETAILS(23)</a>
            <a href="" class="item">AWAITING MY REVIEW(10)</a>
            <a href="" class="item">DELIVERED(24)</a>
            <a href="" class="item">COMPLETED(10)</a>
            <a href="" class="item">CANCELLED(4)</a>
            <a href="" class="item">ALL ORDERS(50)</a>
        </section>

        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between">
                <h3 class="title">Active Service</h3>
                <div class="btns">
                    <a href="" class="btn btn-yallow">Add New Service</a>
                </div>
            </header>
            <div class="sec-content">
                <div class="table-responsive">
                    <table class="table table-borderless cs-table-2">
                        <thead>
                        <tr>
                            <th>Services</th>
                            <th>Impressions</th>
                            <th>Clicks</th>
                            <th>Orders </th>
                            <th>Cancellations</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                    <div class="media-body">
                                        <h3>I will do 3 unique minimalist logo design</h3>
                                    </div>
                                </div>
                            </td>
                            <td>323</td>
                            <td>200</td>
                            <td>30</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                    <div class="media-body">
                                        <h3>I will do 3 unique minimalist logo design</h3>
                                    </div>
                                </div>
                            </td>
                            <td>723</td>
                            <td>500</td>
                            <td>10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                    <div class="media-body">
                                        <h3>I will do 3 unique minimalist logo design</h3>
                                    </div>
                                </div>
                            </td>
                            <td>9812</td>
                            <td>800</td>
                            <td>300</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                    <div class="media-body">
                                        <h3>I will do 3 unique minimalist logo design</h3>
                                    </div>
                                </div>
                            </td>
                            <td>12</td>
                            <td>4</td>
                            <td>1</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                    <div class="media-body">
                                        <h3>I will do 3 unique minimalist logo design</h3>
                                    </div>
                                </div>
                            </td>
                            <td>12</td>
                            <td>4</td>
                            <td>1</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </section>
@endsection
