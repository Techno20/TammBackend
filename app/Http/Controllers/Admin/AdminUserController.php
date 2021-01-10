<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\User;

class AdminUserController extends Controller
{
	/**
	 * Show user details
	 * 
	 * @param integer $userId
	 * @param object $q Request data
	 */
	public function getShow($userId,Request $q)
	{
		$User = User::where('id',$userId)->with(['Orders' => function($Orders){
			return $Orders->with(['Service' => function($Service){
				return $Service->selectCard();
			}])->orderBy('created_at','DESC')->take(6);
		}])->withTotalSpending()->withTotalProfit()->first();
		if(!$User){
			return Helper::responseData('user_not_found',false,__('default.error_message.user_not_found'));
		}
		return Helper::responseData('success',true,$User);
	}


	/**
	 * Delete user
	 * 
	 * @param object $q Request data
	 */
	public function Delete($userId,Request $q)
	{
		$DeleteUser = User::where('id',$userId)->select('id')->first();
		if(!$DeleteUser){
			return Helper::responseData('user_not_found',false,__('default.error_message.user_not_found'));
		}
		// Check if the user has orders then dont delete it
		$checkOrders = \App\Models\Order::where('user_id',$userId)->count();
		if($checkOrders){
			return Helper::responseData('user_has_orders',false,__('messages.errors.user_has_orders'));
		}
		$DeleteUser->delete();
		return Helper::responseData('success',true);
	}
	
	/**
	 * Set user as Admin
	 * 
	 * @param object $q Request data
	 */
	public function putSetAdmin($userId,$type,Request $q)
	{
		$User = User::where('id',$userId)->select('id','is_admin','is_supervisor')->first();
		$User->is_admin = 1;
		if($type == 'supervisor'){
			$User->is_supervisor = 1;
		}
		$User->save();
		return Helper::responseData('success',true);
	}

	/**
	 * Edit user information
	 * 
	 * @param object $q Request data
	 */
	public function postEdit($userId,Request $q)
	{
		/* Start Validation */
		$validationRules = [
			'name' => 'required',
			'email' => 'required|email',
			'phone' => [new \App\Rules\PhoneRule]
		];
		$validator = Validator::make($q->all(), $validationRules);
		
		if($validator->fails()) {
			return Helper::responseValidationError($validator->messages());
		}
		/* End Validation */
		$User = User::where('id',$userId)->first();
		if(!$User){
			return Helper::responseData('user_not_found',false,__('default.error_message.user_not_found'));
		}
		$User->name = $q->name;
		$User->phone = $q->phone;
		$User->email = $q->email;
		if($q->password){
			$User->password = bcrypt($q->password);
		}
		$User->bank_id = $q->bank_id;
		$User->bank_iban = $q->bank_iban;
		$User->bank_account_owner_name = $q->bank_account_owner_name;
		$User->save();
		return Helper::responseData('success',true);
	}
}
