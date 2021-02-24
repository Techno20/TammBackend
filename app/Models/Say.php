<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Say extends Model
{

    protected $table = 'sayes';
    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    
}
