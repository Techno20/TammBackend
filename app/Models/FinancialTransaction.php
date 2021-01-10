<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper;
class FinancialTransaction extends Model
{
    protected $table = 'financial_transactions';
    protected $appends = [
        'type_string'
    ];

    
    /* START RELATIONS */


    // Service
    public function Service(){
        return $this->belongsTo('App\Models\Service')->selectCard();
    }

    // User
    public function User(){
        return $this->belongsTo('App\Models\User')->selectCard();
    }

    // Order
    public function Order(){
        return $this->belongsTo('App\Models\Order');
    }


    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getTypeStringAttribute(){
        return __('default.other.transaction_types.'.$this->type);
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
