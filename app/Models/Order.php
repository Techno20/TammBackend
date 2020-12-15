<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $hidden = ['pay_gateway_reference'];
    
    /* START RELATIONS */

    // Service
    public function Service(){
        return $this->belongsTo('App\Models\Service')->selectCard();
    }
}
