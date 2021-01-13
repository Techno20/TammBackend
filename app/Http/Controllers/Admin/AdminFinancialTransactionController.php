<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail,Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB, Helper;
use App\Models\FinancialTransaction;
use App\Models\FinancialWithdrawRequest;

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
		$FinancialTransaction = FinancialTransaction::where('id',$transactionId)->with(['User','Order','Service'])->first();
		if(!$FinancialTransaction){
			return Helper::responseData('transaction_not_found',false,false,__('default.error_message.transaction_not_found'),404);
		}
		return Helper::responseData('success',true,$FinancialTransaction);
	}

	/**
	 * Reject financial withdraw request
	 * 
	 * @param object $q Request data
	 */
	public function postWithdrawReject($financialWithdrawRequestId,Request $q)
	{
		$FinancialWithdrawRequest = FinancialWithdrawRequest::where('id',$financialWithdrawRequestId)->first();
		if(!$FinancialWithdrawRequest){
			return Helper::responseData('financial_withdraw_request_not_found',false,false);
		}
		
		$FinancialWithdrawRequest->status = 'rejected';
		$FinancialWithdrawRequest->rejected_reason = $q->rejected_reason;
		$FinancialWithdrawRequest->status_updated_at = date('Y-m-d H:i:s');
		$FinancialWithdrawRequest->save();

		return Helper::responseData('success',true);
	}

	/**
	 * Pay financial transaction
	 * 
	 * @param object $q Request data
	 */
	public function postWithdrawPay($financialTransactionId,Request $q)
	{
		$FinancialWithdrawRequest = FinancialWithdrawRequest::where('id',$financialWithdrawRequestId)->first();
		if(!$FinancialWithdrawRequest){
			return Helper::responseData('financial_withdraw_request_not_found',false,false);
		}
		
		$FinancialWithdrawRequest->status = 'paid';
		$FinancialWithdrawRequest->status_updated_at = date('Y-m-d H:i:s');
		$FinancialWithdrawRequest->save();

        /**
         * Log a financial transaction withdraw transaction
         */
        User::logFinancialTransaction(
            [
                'user_id' => $FinancialWithdrawRequest->user_id,
                'type' => 'withdraw',
                'amount' => $FinancialWithdrawRequest->amount
            ]
        );

		return Helper::responseData('success',true);
	}
}
