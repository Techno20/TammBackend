@extends('site.user.dashboard.layout.main')

@section('css')
    <style>
        .stauts-label {
            font-size: 10px;
            font-family: 'font700', sans-serif;
            background-color: #AFF9F3;
            color: #03B873;
            border-radius: 20px;
            padding: 5px 10px;
        }

        .stauts-label.red {
            background-color: #FCF4E4;
            color: #FCB52D;
        }

        .serv-seller-box .summbary .info {
            flex: 1 1 50%;
        }
    </style>

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        .actions-buttons{
            border-radius: 25px;
            font-family: var(--font700);
            font-size: 11px !important;
        }
    </style>

    <style>
        .cont {
            width: 93%;
            max-width: 350px;
            text-align: center;
            margin: 4% auto;
            padding: 30px 0;
            background: #111;
            color: #EEE;
            border-radius: 5px;
            border: thin solid #444;
            overflow: hidden;
        }

        hr {
            margin: 20px;
            border: none;
            border-bottom: thin solid rgba(255,255,255,.1);
        }

        div.title { font-size: 2em; }

        h1 span {
            font-weight: 300;
            color: #Fd4;
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
    </style>
@endsection

@section('js')

    @if($order->status == 'delivered' && $order->Service->user_id != auth()->user()->id)
        @if(\App\Models\ServiceReview::where('order_id' , $order->id)->count() == 0)
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#ratingModal').modal('show');
                });
            </script>
        @endif
    @endif


@endsection

@section('content')
    <section class="main-page-content flex-grow-1">
        <!-- header -->
        <header class="dashboard-header d-flex align-items-center justify-content-between">
            <div class="title">
                <h3>@lang('site.orders')</h3>
                <p>
                    @lang('site.welcome'), {{ auth()->user()->name }} @lang('site.welcome_back')
                </p>
            </div>
            @include('site.user.dashboard.includes.notifications')
        </header>

        <section class="filter-cats-sec">
            <a href="{{ url('user/order/list/seller') }}" class="item active">@lang('site.back_to_orders')</a>
        </section>

        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between filter-cats-sec">
                <h3 class="title">@lang('site.order_details')</h3>

                @if($order->status == 'delivered' && $order->Service->user_id != auth()->user()->id)
                    @if(\App\Models\ServiceReview::where('order_id' , $order->id)->count() == 0)
                        <a href="#" class="item active"
                           data-toggle="modal" data-target="#ratingModal">@lang('site.rating_service_title')</a>
                    @endif
                @endif
            </header>
            <div class="sec-content">
                <div class="table-responsive">

                    <div class="serv-seller-box">

                        <div class="summbary d-flex">
                            <div class="info">
                                <label>@lang('site.order_id')</label>
                                <p>{{ $order->id }}</p>
                            </div>

                            <div class="info">
                                <label>@lang('site.service_name')</label>
                                <p>{{ $order->Service()->selectCard()->first()->title }}</p>
                            </div>

                        </div>

                        <div class="summbary d-flex">
                            <div class="info">
                                <label>@lang('site.status')</label>
                                <p><span class="stauts-label @if($order->status == 'canceled') red @endif">@lang('default.other.order_status.'.$order->status)</span></p>
                            </div>


                            <div class="info">
                                <label>@lang('site.Order_Date')</label>
                                <p>{{ date('M d',strtotime($order->created_at)) }}</p>
                            </div>

                        </div>

                        <div class="summbary d-flex">
                            <div class="info">
                                <label>@lang('site.total')</label>
                                <p>{{ $order->paid_total }} @lang('site.sar')</p>
                            </div>


                            @if($order->user_id != auth()->user()->id)
                                <div class="info">
                                    <label>@lang('site.commission_rate')</label>
                                    <p>{{ $order->commission_rate }} %</p>
                                </div>
                            @endif

                        </div>

                        @if($order->user_id != auth()->user()->id)
                            <div class="summbary d-flex">
                                <div class="info">
                                    <label>@lang('site.total_after_commission')</label>
                                    <p>{{ number_format($order->total_after_commission, 2) }} @lang('site.sar')</p>
                                </div>
                            </div>
                        @endif



                        <div class="summbary d-flex">
                            <div class="info">
                                <label>@lang('site.requirements')</label>
                                <p>{{ $order->requirements_details }}</p>
                            </div>

                        </div>



                        <div class="summbary d-flex">
                            <div class="info">
                                <label>@lang('site.requirements_attachments')</label>
                                @if($order->requirements_attachments)
                                    <p>
                                        <a href="{{ asset($order->getRequirementsAttachmentsURL()) }}" target="_blank" class="btn btn-yallow">@lang('site.show_attachments')</a>
                                    </p>
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>

                        @if($order->status == 'delivered')
                            <div class="summbary d-flex">
                                <div class="info">
                                    <label>@lang('site.delivered_order_message')</label>
                                    <p>{{ $order->service_delivery }}</p>
                                </div>

                            </div>

                            <div class="summbary d-flex">
                                <div class="info">
                                    <label>@lang('site.delivered_order_attachments')</label>
                                    <p>
                                        <a href="{{ asset($order->getServiceDeliveryAttachmentsURL()) }}" target="_blank" class="btn btn-yallow">@lang('site.show_attachments')</a>
                                    </p>
                                </div>
                            </div>
                        @endif

                    </div>


                </div>
            </div>
        </section>

    </section>

    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('site.rating_service_title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.order.post.rating' , $order->id) }}"
                      method="POST">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="form-lable" for="service-title">@lang('site.rating_service_text')</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea id="service-title"
                                              name="comment"
                                              class="form-control input_to_count title"
                                              placeholder="@lang('site.rating_service_text_example')"
                                              rows="2" required></textarea>
                                    <div class="wizard-form-error"
                                         style="display: block;"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-success actions-buttons">@lang('site.rating_service')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
