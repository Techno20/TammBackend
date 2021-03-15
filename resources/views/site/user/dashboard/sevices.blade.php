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
            @include('site.user.dashboard.includes.notifications')
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
