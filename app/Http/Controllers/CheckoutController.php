<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\ServiceExtra;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\Setting;
use Helper;
use Illuminate\Support\Facades\Redirect;

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
//        return Helper::responseData('success',true,$Result);
        return view('site.user.order.create')->with('result',$Result);
    }

    /**
     * Send order
     *
     * @param Request $q
     */
    public function postSendOrder(Request $q)
    {
        dd($q->all());
        $validator = validator()->make(request()->all(), [
            'service_id' => 'required',
            'extra_services' => 'nullable|array',
            'package' => 'required'
        ]);
        if($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $Service = Service::where('id',$q->service_id)->first();
        if(!$Service) {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }

//        session()->put('checkout', $q);
//
//        $paidTotal = 0;
//
//        $Package = ($q->package && $q->package != 'basic') ? $q->package : 'basic';
//        $paidTotal += $Service->{$Package.'_price'};
//
//        if(is_array($q->extra_services) && count($q->extra_services)){
//            foreach($q->extra_services as $extraServiceId){
//                $getExtraService = ServiceExtra::where([['id',$extraServiceId],['service_id',$q->service_id]])->first();
//                if($getExtraService){
//                    $paidTotal += $getExtraService->price;
//                }
//            }
//        }
//
//        $payment = Helper::payment(auth()->user(), $paidTotal);
//
//        dd($payment);

        $paidTotal = 0;

        // Subtract package price
        $Package = ($q->package && $q->package != 'basic') ? $q->package : 'basic';
        $paidTotal += $Service->{$Package.'_price'};

        // Subtract extra services prices
        if(is_array($q->extra_services) && count($q->extra_services)){
            $insertOrderExtraServices = [];
            foreach($q->extra_services as $extraServiceId){
                // Get extra service price
                $getExtraService = ServiceExtra::where([['id',$extraServiceId],['service_id',$q->service_id]])->first();
                if($getExtraService){
                    // Subtract extra service price
                    $paidTotal += $getExtraService->price;
                    $insertOrderExtraServices[] = [
                        'order_id' => $getExtraService->service_id,
//                        'service_id' => $getExtraService->service_id,
                        'services_extra_id' => $getExtraService->id,
                        'pay_total' => $getExtraService->price
                    ];
                }
            }
            // Save extra services to current order
            if(count($insertOrderExtraServices)){
                OrderExtra::insert($insertOrderExtraServices);
            }
        }


        // Get commission rate from setting
        $commissionRate = Setting::select('commission_rate')->first()->commission_rate;

        $Order = new Order;
        $Order->user_id = auth()->user()->id;
        $Order->service_id = $Service->id;
        $Order->package = $Package;
        $Order->paid_total = $paidTotal;
        $Order->commission_rate = $commissionRate;
        $Order->requirements_details = $q->requirements_details;
        $Order->requirements_attachments = $q->requirements_attachments;
        $Order->save();



        /**
         * Log a financial transaction for both order submitter and service provider
         */
        User::logFinancialTransaction(
            [
                'user_id' => auth()->user()->id,
                'type' => 'charge',
                'amount' => $Order->paid_total,
                'order_id' => $Order->id,
                'service_id' => $Service->id
            ]
        );

        return Helper::responseData('success',true);
    }
}
