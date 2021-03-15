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
use Illuminate\Support\Facades\DB;
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

        $paidTotal = 0;

        $Package = ($q->package && $q->package != 'basic') ? $q->package : 'basic';
        $paidTotal += $Service->{$Package.'_price'};

        if(is_array($q->extra_services) && count($q->extra_services)){
            foreach($q->extra_services as $extraServiceId){
                $getExtraService = ServiceExtra::where([['id',$extraServiceId],['service_id',$q->service_id]])->first();
                if($getExtraService){
                    $paidTotal += $getExtraService->price;
                }
            }
        }

        $payment = Helper::payment(auth()->user(), $paidTotal, $q->payment_token);

        if (isset($payment['status']) && $payment['status'] == 'INITIATED' && isset($payment['transaction']) && isset($payment['transaction']['url'])) {
            $data = $q->toArray();
            if ($q->hasFile('requirements_attachments')) {
                $upload = new UploaderController();
                $upload->folder = 'orders';
                $upload->thumbFolder = 'orders/thumbs';
                $galleryItemResponse = $upload->uploadSingle($q['requirements_attachments'],false);
                session()->put('checkout_file', $galleryItemResponse);
                unset($data['requirements_attachments']);
            }
            session()->put('checkout', $data);
            return response()->json([
                'status' => true,
                'message' => 'success',
                'url' => $payment['transaction']['url']
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'error',
        ]);
    }
}
