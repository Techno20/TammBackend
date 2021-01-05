<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper;
class FinancialWithdrawRequest extends Model
{
    protected $table = 'financial_withdraw_requests';
    protected $appends = [
    ];
    public $timestamps = false;

    
    /* START RELATIONS */

    // Financial Transaction
    public function FinancialTransaction(){
        return $this->belongsTo('App\Models\FinancialTransaction');
    }

    // User
    public function User(){
        return $this->belongsTo('App\Models\User')->selectCard();
    }

    /* START ATTRIBUTES */
    public function getStatusStringAttribute(){
        return __('default.other.transaction_withdraw_status.'.$this->type);
    }

    /* START SCOPES */


    /**
     * Check if the users is authorized to manage the current order
     */
    public function scopeAuthorized($query)
    {
        return $query->where($this->table.'user_id',auth()->user()->id);
    }
}
