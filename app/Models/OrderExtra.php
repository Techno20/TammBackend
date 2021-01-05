<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderExtra extends Model
{
    protected $table = 'orders_extras';
    protected $timestamps = false;
    /* START RELATIONS */
    
    // Service Extra Details
    public function Extra(){
        return $this->belongsTo('App\Models\ServiceExtra','services_extra_id','id');
    }
}
