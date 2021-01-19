<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'list_of_skills';

    // User Skills
    public function UserSkills(){
        return $this->hasMany('App\Models\UserSkill');
    }

    /* START ATTRIBUTES */
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }


    /* START SCOPES */
    public function scopeSelectCard($query)
    {
        return $query->select('id','name_'.app()->getLocale().' as name');
    }
}
