<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{

  protected $table = 'services_reviews';

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at','user_id','service_id'
  ];

  /* START RELATIONS */
  // Service
  public function Service(){
    return $this->belongsTo('App\Models\Service');
  }

  // User
  public function User(){
    return $this->belongsTo('App\Models\User')->selectCard();
  }

  /* START SCOPES */

  public function scopeSelectCard($query)
  {
    return $query->with('User');
  }

}
