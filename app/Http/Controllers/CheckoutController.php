<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use Helper;

class CheckoutController extends Controller
{

    /**
     * Get order details
     * 
     * @param Request $q
     */
    public function getOrderDetails(Request $q)
    {
        $validator = validator()->make(request()->all(), [
            'service_id' => 'required'
        ]);
        if($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $Package = ($q->package && $q->package != 'basic') ? $q->package : 'basic'; 
        $Service = Service::where('id',$q->service_id)->select('*')->selectRatingAverage();
        $Service = $Service->with(['Image','Category','User'])->withCount('Reviews');
        if(auth()->user() && !auth()->user()->is_admin){
            $Service = $Service->where(function($qu){
                return $qu->where([['is_approved',1],['is_active',1]])->orWhere('user_id',auth()->user()->id);
            });
        }
        $Service = $Service->first();
        if(!$Service) {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }

        $deliveryDays = $Service->{$Package.'_delivery_days'};
        $OrderSummary = [
            'total' => $Service->{$Package.'_price'},
            'delivery_time' => ($deliveryDays == 0) ? __('default.other.delivery.same_day') : __('default.other.delivery.x_day',['day' => $deliveryDays])
        ];

        $Result = [
            'service' => $Service,
            'order_summary' => $OrderSummary
        ];
        return Helper::responseData('success',true,$Result);
    }

    /**
     * Send order
     * 
     * @param Request $q
     */
    public function postSendOrder(Request $q)
    {
        $validator = validator()->make(request()->all(), [
            'service_id' => 'required',
            'attachments' => 'array'
        ]);
        if($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $Service = Service::where('id',$q->service_id)->first();
        if(!$Service) {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }

        $Package = ($q->package && $q->package != 'basic') ? $q->package : 'basic'; 
        $Price = $Service->{$Package.'_price'};
        $commissionRate = Setting::select('commission_rate')->first()->commission_rate;

        $Order = new Order;
        $Order->user_id = auth()->user()->id;
        $Order->service_id = $Service->id;
        $Order->package = $Package;
        $Order->paid_total = $Price;
        $Order->commission_rate = $commissionRate;
        $Order->requirements_details = $q->requirements_details;
        $Order->requirements_attachments = $q->requirements_attachments;
        $Order->save();

        return Helper::responseData('success',true);
    }
}
