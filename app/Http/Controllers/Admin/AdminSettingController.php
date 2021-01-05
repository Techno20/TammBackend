<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\Setting;

class AdminSettingController extends Controller
{
	/**
	 * Get settings
	 * 
	 * @param object $q Request data
	 */
	public function getSettings(Request $q)
	{
		$Settings = Setting::first();
		return Helper::responseData('success',true,$Settings);
	}

	/**
	 * Save settings
	 * 
	 * @param object $q Request data
	 */
	public function postSaveSettings(Request $q)
	{
		$validator = validator()->make(request()->all(), [
			'commission_rate' => 'numeric',
			'contact_email' => 'email'
		]);
		if($validator->fails()) {
			return Helper::responseValidationError($validator->messages());
		}
		$Settings = Setting::first();
		$Settings->contact_email = $q->contact_email;
		$Settings->commission_rate = $q->commission_rate;
		$Settings->save();
		return Helper::responseData('success',true,$Settings);
	}

}
