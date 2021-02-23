<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowWeWork extends Model
{

    protected $table = 'how_we_work';
    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    
}
