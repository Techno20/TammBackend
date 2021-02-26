@extends('site.user.dashboard.layout.main')

@section('css')
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

        <!-- filter -->
        <section class="filter-cats-sec">
            <a href="{{ url('user/order/list/seller') }}" class="item @if($type == 'seller') active @endif">@lang('site.client_orders') @if($type == 'seller') ({{$orders->count()}}) @endif</a>
            <a href="{{ url('user/order/list/buyer') }}" class="item @if($type == 'buyer') active @endif">@lang('site.my_orders') @if($type == 'buyer') ({{$orders->count()}}) @endif</a>
            <a href="{{ url('user/order/list/all') }}" class="item @if($type == 'all') active @endif">@lang('site.all_order') @if($type == 'all') ({{$orders->count()}}) @endif</a>
        </section>

        <!-- table -->
        <section class="table-list-section">
            <header class="tl-header d-flex align-items-center justify-content-between">
                <h3 class="title">@lang('site.orders')</h3>
            </header>
            <div class="sec-content">
                <div class="table-responsive">
                    @if(isset($orders) && !empty($orders) && $orders->count() > 0)
                    <table class="table table-borderless cs-table-2">
                        <thead>
                        <tr>
                            <th>@lang('site.service')</th>
                            <th>@lang('site.order_date')</th>
                            <th>@lang('site.last_update')</th>
                            <th>@lang('site.total') </th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.operations')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $value)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        @if($value->Service->image && $value->Service->image->path)
                                            <img src="{{ asset('storage/services/gallery/'.$value->Service->image->path) }}">
                                        @else
                                            <img src="{{ asset('assets/site/images/dashboard/s-1.png') }}">
                                        @endif
                                        <div class="media-body">
                                            <h3><a href="{{ route('user.order.details' , $value->id) }}">{{ $value->Service()->selectCard()->first()->title }}</a></h3>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ date('M d',strtotime($value->created_at)) }}</td>
                                <td>{{ date('M d',strtotime($value->status_updated_at)) }}</td>
                                <td>{{ $value->paid_total }} $</td>
                                <td><span class="stauts-label @if($value->status == 'canceled') red @endif">@lang('default.other.order_status.'.$value->status)</span></td>
                                <td>

                                    @if($value->status == 'current' && $value->Service->user_id == auth()->user()->id)
                                        <button type="button" class="btn btn-success actions-buttons"
                                                data-toggle="modal" data-target="#deliveryModal{{ $value->id }}">@lang('default.other.order_status.delivered')</button>
                                        <button type="button" class="btn btn-danger actions-buttons">@lang('site.cancel_order')</button>

                                        <div class="modal fade" id="deliveryModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">@lang('site.finish_order_delivered')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user.order.post.delivery' , $value->id) }}"
                                                          method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <div class="form-row">
                                                                <div class="col-md-3">
                                                                    <label class="form-lable" for="service-title">@lang('site.delivered_order_message')</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class="form-group">
                                                                            <textarea id="service-title"
                                                                                      name="service_delivery"
                                                                                      class="form-control input_to_count title"
                                                                                      placeholder="@lang('site.delivered_order_message_example')"
                                                                                      rows="2" required></textarea>
                                                                        <div class="wizard-form-error"
                                                                             style="display: block;"></div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-3">
                                                                    <label class="form-lable" for="service-title">@lang('site.delivered_order_attachments')</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class="form-group">
                                                                        <input type="file"
                                                                               name="service_delivery_attachments"
                                                                               class="form-control"
                                                                               required style="height: 40px;">
                                                                        <div class="wizard-form-error"
                                                                             style="display: block;"></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                    class="btn btn-success actions-buttons">@lang('default.other.order_status.delivered')</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    @elseif($value->status == 'delivered' && $value->Service->user_id != auth()->user()->id)
                                        @if(\App\Models\ServiceReview::where('order_id' , $value->id)->count() == 0)
                                        <button type="button" class="btn btn-yallow"
                                                data-toggle="modal" data-target="#ratingModal{{ $value->id }}">@lang('site.rating_service')</button>

                                        <div class="modal fade" id="ratingModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">@lang('site.rating_service_title')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user.order.post.rating' , $value->id) }}"
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
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{ $orders->links() }}
                    @else
                        <div class="alert alert-danger  text-danger">@lang('site.sorry_no_data')</div>
                    @endif
                </div>
            </div>
        </section>

    </section>
@endsection
