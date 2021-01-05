<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Storage, DB, Helper;

class AdminHelpersController extends Controller
{

	/**
	 * Get list items
	 * 
	 * @param string $type
	 */
	public function getList($type,Request $q)
	{
		switch($type){
			case 'categories':
				$List = \App\Models\Category::selectCard();
				if($q->main_category_type){
					$List = $List->where('main_category_type',$q->main_category_type);
				}
				if($q->search){
					$List = $List->where('name_ar','LIKE','%'.$q->search.'%');
				}elseif($q->category_id && $q->category_id != 'all'){
					$List = $List->where('id',$q->category_id);
				}
				$List = $List->get();
			break;
			case 'users':
				$List = \App\Models\User::selectCard();
				if($q->search){
					$List = $List->where('name','LIKE','%'.$q->search.'%')->orWhere('email','LIKE','%'.$q->search.'%');
				}elseif($q->user_id && $q->user_id != 'all'){
					$List = $List->where('id',$q->user_id);
				}
				$List = $List->take(10)->get();
			break;
			default:
				return Helper::responseData('list_not_found',false);
			break;
		}
		return Helper::responseData('success',true,$List);
	}

}
