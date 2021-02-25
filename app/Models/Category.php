<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $appends = ['main_category_type_string'];

    /* START RELATIONS */

    // Providers
    public function Services(){
      return $this->hasMany('App\Models\Service');
    }

    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }


    /**
     * Get main category type as string
     */
    public function getMainCategoryTypeStringAttribute(){
      return __('default.other.main_category_types.'.$this->main_category_type);
    }


    /* START SCOPES */
    public function scopeSelectCard($query)
    {
      return $query->select('id','main_category_type','image','name_'.app()->getLocale().' as name');
    }

}
