@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">
        <!-- account-setting-page -->
        <section class="account-setting-page">
            <div class="container">
                <div class="row">
                    @include('site.layout.common.settings')
                    <div class="col-xl-8">
                        <div class="setting-sidebar-overlay"></div>
                        <button type="button" id="openSettingSidebar" class="btn setting-sidebar-toggle"><i class="fas fa-bars"></i></button>
                        <div class="account-setting-body">
                            <header class="setting-body-header">
                                <h1>Your Account Balance</h1>
                                <p>When available, we use your funds and credits as your primary payment method for new orders.</p>
                            </header>
                            <div class="sec-content">
                                <div class="setting-balance-sec">
                                    <div class="balance-summary-sec">
                                        <div class="shead">
                                            <div class="item d-flex align-items-center">
                                                <div class="text">FIVERR BALANCE</div>
                                                <div class="value">TOTAL $0.00</div>
                                            </div>
                                        </div>
                                        <div class="sbody">
                                            <div class="item d-flex align-items-center">
                                                <div class="text">Your Earnings</div>
                                                <div class="value">TOTAL $0.00</div>
                                            </div>
                                            <div class="item d-flex align-items-center">
                                                <div class="text">
                                                    Your Reimbursements
                                                    <p>Funds that were credited back to your account for canceled orders.</p>
                                                </div>
                                                <div class="value">TOTAL $0.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account-setting-page -->
    </div>
@endsection
