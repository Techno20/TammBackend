<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'list_of_skills';

    /* START SCOPES */
    public function scopeSelectCard($query)
    {
        return $query->select('id','name_'.app()->getLocale().' as name');
    }
}
