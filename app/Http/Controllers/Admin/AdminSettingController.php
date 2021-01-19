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
	 * Get general settings
	 * 
	 * @param object $q Request data
	 */
	public function getGeneral(Request $q)
	{
		$Settings = Setting::first();
		return Helper::responseData('success',true,$Settings);
	}

	/**
	 * Save general
	 * 
	 * @param object $q Request data
	 */
	public function postSaveGeneral(Request $q)
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

	/**
	 * Save list item
	 * 
	 * @param string $itemType
	 * @param object $q Request data
	 */
	public function postSaveListItem($itemType,Request $q)
	{
		switch($itemType){
			case 'banks':
				$Item = new \App\Models\Bank;
			break;
			case 'countries':
				$Item = new \App\Models\Country;
			break;
			case 'categories':
				$Item = new \App\Models\Category;
			break;
			case 'skills':
				$Item = new \App\Models\Skill;
			break;
			case 'admins':
				$Item = \App\Models\User::where('id',$q->id)->first();
				$Item->is_admin = 1;
				$Item->is_admin_permissions = $q->is_admin_permissions;
				$Item->save();
				return Helper::responseData('success',true,$Item);
			break;
		}

		if(isset($Item)){
			if($q->id){
				$Item = $Item->where('id',$q->id)->first();
				if(!$Item){
					return Helper::responseData('item_not_found',false);
				}
			}
			if($itemType == 'categories'){
				$Item->main_category_type = $q->main_category_type;
			}
			$Item->name_ar = $q->name_ar;
			$Item->name_en = $q->name_en;
			$Item->save();
			return Helper::responseData('success',true,$Item);
		}

	}

	/**
	 * Delete list item
	 * 
	 * @param string $itemType
	 * @param mixed $itemId if does not exist then Add
	 */
	public function postDeleteListItem($itemType,$itemId,Request $q)
	{
		switch($itemType){
			case 'banks':
				$Item = new \App\Models\Bank;
			break;
			case 'countries':
				$Item = new \App\Models\Country;
			break;
			case 'categories':
				$Item = new \App\Models\Category;
			break;
			case 'skills':
				$Item = new \App\Models\Skill;
				$deleteUserSkills = \App\Models\UserSkill::where('skill_id',$itemId)->delete();
			break;
			case 'contactus-messages':
				$Item = new \App\Models\ContactusMessage;
			break;
			case 'admins':
				if($itemId != auth()->user()->id){
					$Item = \App\Models\User::where([['id',$itemId],['is_admin',1]])->first();
					if(!$Item){
						return Helper::responseData('item_not_found',false);
					}
					$Item->is_admin = 0;
					$Item->is_admin_permissions = null;
					$Item->save();
					return Helper::responseData('success',true);
				}else {
					return Helper::responseData('error',false);
				}
			break;
		}
		if(isset($Item)){
			$Item = $Item->where('id',$itemId)->delete();
			return Helper::responseData('success',true);
		}
	}


}
