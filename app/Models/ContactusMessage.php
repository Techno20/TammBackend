<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactusMessage extends Model
{
    protected $table = 'contactus_messages';

    /* START ATTRIBUTES */

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }
}
