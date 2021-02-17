<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'list_of_countries';

    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    /* START RELATIONS */

    // Users
    public function Users(){
      return $this->hasMany('App\Models\User','country_id','id');
    }

    /* START SCOPES */
    public function scopeSelectCard($query)
    {
        return $query->select('id','name_'.app()->getLocale().' as name');
    }

}
