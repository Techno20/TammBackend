<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Helper;
use App\Models\Order,App\Models\User;

class UserOrderController extends Controller
{

    /**
     * Get orders list
     *
     * @param $type (seller|buyer|all)
     */
    public function getList($type)
    {

        if($type == 'seller')
            $orders = Order::with('Service')->whereHas('Service', function ($Service) {
                return $Service->where('user_id', auth()->user()->id);
            })->paginate(50);

        elseif($type == 'buyer')
            $orders = Order::with('Service')->where('user_id', auth()->user()->id)->paginate(50);
        elseif($type == 'all')
            $orders = Order::with('Service')->where('user_id', auth()->user()->id)
                ->orWhereHas('Service', function ($Service) {
                    return $Service->where('user_id', auth()->user()->id);
                })->paginate(50);

        return view('site.user.dashboard.orders')->with(['orders' => $orders , 'type' => $type]);

//      $validator = validator()->make(request()->all(), [
//          'main_category_type' => [new \App\Rules\MainCategoryTypeRule],
//          'category_id' => 'integer',
//          'start_date' => 'date',
//          'end_date' => 'date'
//      ]);
//      if($validator->fails()) {
//        return Helper::responseValidationError($validator->messages());
//      }
//
//      $Orders = Order::with('Service');
//      if($Type == 'seller'){
//        $Orders->whereHas('Service',function($Service){
//          return $Service->where('user_id',auth()->user()->id);
//        });
//          if(!request()->has('status')){
//              $Orders = $Orders->where('status','current');
//          }
//      }else {
//        $Orders = $Orders->where('user_id',auth()->user()->id);
//      }
//
//      // Filters
//
//      // By status
////      if(request()->status == 'delivered'){
////        $Orders = $Orders->where('status','delivered');
////      }else {
////        $Orders = $Orders->where('status','!=','delivered');
////      }
//      if(request()->has('status') && in_array(request()->status,['canceled','current','delivered'])){
//        $Orders = $Orders->where('status',request()->status);
//      }
//
//      // By dates
//      if(request()->start_date){
//        $Orders = $Orders->whereRaw('DATE(created_at) >= "'.request()->start_date.'"');
//      }
//      if(request()->end_date){
//        $Orders = $Orders->whereRaw('DATE(created_at) <= "'.request()->start_date.'"');
//      }
//
//
//      // By main category type or category
//      if(request()->main_category_type || request()->category_id){
//        $Orders = $Orders->whereHas(function($Service){
//          if (request()->main_category_type) {
//            $Service = $Service->where('main_category_type',request()->main_category_type);
//          }
//          if (request()->category_id) {
//            $Service = $Service->where('category_id',request()->category_id);
//          }
//          return $Service;
//        });
//      }
//
//
//
//      $Orders = $Orders->paginate(50);
////      return Helper::responseData('success',true,$Orders);
//        return view('site.user.dashboard.orders')->with('orders',$Orders);
    }

    /**
     * Get order details
     *
     * @param integer $orderId
     * @param Request $q
     */
    public function getShow($orderId,Request $q)
    {
        $type = 'seller';
        $order = Order::findOrFail($orderId);

        return view('site.user.dashboard.order-details' , compact('type' , 'order'));
    }

    /**
     * Delivery order stuff
     *
     * @param integer $orderId
     * @param Request $q
     */
    public function postDelivery($orderId,Request $q)
    {

        $validator = validator()->make($q->all(), [
            'service_delivery' => 'required',
            'service_delivery_attachments' => 'array'
        ]);


        if($validator->fails()) {
        return Helper::responseValidationError($validator->messages());
        }

        $Order = Order::where('id',$orderId)->whereHas('Service',function($Service){
          return $Service->where('user_id',auth()->user()->id);
        })->first();
        if(!$Order) {
          return Helper::responseData('order_not_found',false,false,__('default.error_message.order_not_found'),404);
        }
        $Order->status = 'delivered';
        $Order->status_updated_at = date('Y-m-d H:i:s');
        $Order->service_delivery = $q->service_delivery;
        $Order->service_delivery_attachments = $q->service_delivery_attachments;
        $Order->save();

        $Order = Order::where('id',$orderId)->with('Service','Extras')->first();

        /**
         * Log a financial transaction for both order submitter and service provider
         */
        User::logFinancialTransaction(
            [
                'user_id' => $Order->Service->user_id,
                'type' => 'profit',
                'amount' => $Order->net_amount,
                'order_id' => $Order->id,
                'service_id' => $Order->Service->id
            ]
        );
        return  redirect()->back()->with(['success' => 'تمت العملية بنجاح']);
    }

    /**
     * Cancel the order as buyer
     *
     * @param integer $orderId
     * @param Request $q
     */
    public function postCancelOrder($orderId,Request $q)
    {
        $validator = validator()->make($q->all(), [
            'service_delivery' => 'required',
            'service_delivery_attachments' => 'array'
        ]);
        if($validator->fails()) {
        return Helper::responseValidationError($validator->messages());
        }

        $Order = Order::where('id',$orderId)->whereHas('Service',function($Service){
          return $Service->where('user_id',auth()->user()->id);
        })->first();
        if(!$Order) {
          return Helper::responseData('order_not_found',false,false,__('default.error_message.order_not_found'),404);
        }
        $Order->status = 'canceled';
        $Order->status_updated_at = date('Y-m-d H:i:s');
        $Order->save();

        /**
         * Log a financial transaction for both order submitter and service provider
         */
        User::logFinancialTransaction(
            [
                'user_id' => $Order->user_id,
                'type' => 'refund',
                'amount' => $Order->paid_total,
                'order_id' => $Order->id,
                'service_id' => $Order->service_id
            ]
        );

        return Helper::responseData('success',true);
    }

}
