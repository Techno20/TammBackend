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
            @include('site.user.dashboard.includes.notifications')
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
                                        <a href="{{ route('user.order.details' , $value->id) }}" type="button" class="btn btn-yallow">@lang('site.rating_service')</a>
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
