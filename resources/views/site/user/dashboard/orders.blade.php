@extends('site.user.dashboard.layout.main')

@section('css')
    <style>
        .actions-buttons{
            border-radius: 25px;
            font-family: var(--font700);
            font-size: 11px !important;
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
                            @if($type == 'seller' || $type == 'all')
                                <th>@lang('site.operations')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $value)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        @if(isset($value->Service()->image) && !empty($value->Service()->image) && !empty($value->Service()->image->path) && file_exists(asset('uploads/services/'.$value->Service()->image->path)))
                                            <img src="{{ asset('uploads/services/'.$value->Service()->image->path) }}">
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
                                    @if($type == 'seller' || $type == 'all')
                                        @if($value->status == 'current')
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
                                                              method="POST">
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
                                                                                   name="service_delivery_attachments[]"
                                                                                   class="form-control" multiple
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
