<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{

  protected $table = 'services_reviews';

    protected $fillable = [
        'order_id',
        'user_id',
        'service_id',
        'comment',
        'rating',
    ];

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at','user_id','service_id'
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
