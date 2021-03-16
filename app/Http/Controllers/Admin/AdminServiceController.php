<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ApprovalServiceNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\Service,App\Models\Category,App\Models\Order,App\Models\User;

class AdminServiceController extends Controller
{

	/**
	 * Show service details
	 *
	 * @param integer $serviceId
	 * @param object $q Request data
	 */
	public function getShow($serviceId,Request $q)
	{
		$Service = Service::where('id',$serviceId)->with(['User','Category','Image','Extras'])->first();
		if(!$Service){
			return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
		}
		return Helper::responseData('success',true,$Service);
	}

	/**
	 * Set Service Approval
	 *
	 * @param object $q Request data
	 */
	public function putSetApproval($serviceId,Request $q)
	{
		$validator = validator()->make(request()->all(), [
			'is_approved' => 'required'
		]);
		if($validator->fails()) {
			return Helper::responseValidationError($validator->messages());
		}

		Service::where('id',$serviceId)->update(['is_approved' => $q->is_approved]);

        $service = Service::find($serviceId);
        $provider = $service->User;
        $provider->notify(new ApprovalServiceNotification($service));

		return Helper::responseData('success',true);
	}


	/**
	 * Delete service
	 *
	 * @param object $q Request data
	 */
	public function Delete($serviceId,Request $q)
	{
		$DeleteService = Service::where('id',$serviceId)->select('id')->first();
		if(!$DeleteService){
			return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
		}
		// Check is the service has orders so cannot delete it.
		$checkOrders = Order::where('service_id',$serviceId)->count();
		if($checkOrders){
			return Helper::responseData('service_has_orders',false,false,__('default.error_message.service_has_orders'),401);
		}

		$DeleteService->delete();
		return Helper::responseData('success',true);
	}
}
