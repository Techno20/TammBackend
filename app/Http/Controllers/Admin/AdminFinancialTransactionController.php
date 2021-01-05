<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\FinancialTransaction;

class AdminFinancialTransactionController extends Controller
{

	/**
	 * Show financial transaction details
	 * 
	 * @param integer $transactionId
	 * @param object $q Request data
	 */
	public function getShow($transactionId,Request $q)
	{
		$FinancialTransaction = FinancialTransaction::where('id',$transactionId)->with(['User'])->first();
		if(!$FinancialTransaction){
			return Helper::responseData('transaction_not_found',false,false,__('default.error_message.transaction_not_found'),404);
		}
		return Helper::responseData('success',true,$FinancialTransaction);
	}

}
