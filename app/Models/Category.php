<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /* START RELATIONS */

    // Providers
    public function Services(){
      return $this->hasMany('App\Models\Service');
    }
  
    /* START SCOPES */
    public function scopeSelectCard($query)
    {
      return $query->select('id','main_category_type','name_'.app()->getLocale().' as name');
    }
}
