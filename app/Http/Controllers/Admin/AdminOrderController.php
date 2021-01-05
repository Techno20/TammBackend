<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\Service,App\Models\Category,App\Models\Order,App\Models\User;

class AdminOrderController extends Controller
{

	/**
	 * Show order details
	 * 
	 * @param integer $orderId
	 * @param object $q Request data
	 */
	public function getShow($orderId,Request $q)
	{
		$Order = Order::where('id',$orderId)->with(['Service' => function($Service){
			return $Service->with(['User','Category']);
		},'User'])->first();
		if(!$Order){
			return Helper::responseData('order_not_found',false,false,__('default.error_message.order_not_found'),404);
		}

		return Helper::responseData('success',true,$Order);
	}

}
