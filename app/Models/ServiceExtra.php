<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServiceExtra extends Model
{
  use SoftDeletes;
  protected $table = 'services_extras';

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at','deleted_at','service_id'
  ];

  /* START ATTRIBUTES */

  public function getCreatedAtAttribute($value){
      return date('Y-m-d H:i:s',strtotime($value));
  }

  public function getUpdatedAtAttribute($value){
      return date('Y-m-d H:i:s',strtotime($value));
  }

  
  /* START RELATIONS */
  // Service
  public function Service(){
    return $this->belongsTo('App\Models\Service');
  }


}
