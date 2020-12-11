<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Storage;
class Service extends Model
{

  protected $table = 'services';

  protected $casts = [
    'category_id' => 'integer',
    'user_id' => 'integer',
    'is_approved' => 'boolean',
    'is_active' => 'boolean'
  ];

  protected $appends = [];

  protected $hidden = [
    'user_id','category_id','deleted_at','updated_at'
  ];

  protected $guarded = [
    'id'
  ];

  /* START ATTRIBUTES */

  /**
   * Get thumbnail
   */
  public function getThumbnailAttribute(){
    return Storage::url('services/thumbs/'.$this->image);
  }

  /**
   * Get Trainer Experiences
   */
  public function getTrainerExperiencesAttribute($value){
    return ($value) ? explode(',',$value) : [];
  }

  /**
   * Get Rating Average Attribute
   */
  public function getRatingAvgAttribute($value){
    return ($value) ? intval($value) : 0;
  }

  /**
   * Get Course Date and Time formatted as Timestamp
   */
  public function getDateTimestampAttribute(){
    return \Carbon\Carbon::createFromTimestamp(strtotime($this->date.' '.$this->time))->timezone(config('app.timezone'))->timestamp;
  }

  /**
   * Get full-size image
   */
  public function getFullsizeImageAttribute(){
    return ($this->image) ? Storage::url('services/gallery/'.$this->image) : null;
  }

  /**
   * Get meta description
   */
  public function getMetaDescriptionAttribute(){
    return substr($this->description,0,160);
  }


  /* START RELATIONS */
  // Category
  public function Category(){
    return $this->belongsTo('App\Models\Category')->select('id',DB::raw('name_'.app()->getLocale().' as name'),'slug');
  }

  // User
  public function User(){
    return $this->belongsTo('App\Models\User','user_id','id')->selectCard()->withTrashed();
  }


  /* START SCOPES */

  public function scopeOnlyApproved($query)
  {
    return $query->where(function($qu){
      $qu = $qu->where('is_approved',1);
      if (auth()->user()) {
        $qu = $qu->orWhere('user_id',auth()->user()->id);
      }
      return $qu;
    });
  }

  public function scopeOnlyActive($query)
  {
    return $query->where('is_active', 1);
  }


  public function scopeSelectRatingAverage($query)
  {
    return $query->addSelect(DB::raw('IFNULL((SELECT AVG(rating) FROM services_reviews WHERE service_id = '.$this->table.'.id),0) as rating_avg'));
  }

  public function scopeSelectIsFavorited($query)
  {
    if(!auth()->user()){
      return $query->addSelect(DB::raw('false AS is_favorited'));
    }else {
      return $query->addSelect(DB::raw('IF((SELECT uf.id FROM user_favourite_services uf WHERE uf.service_id = '.$this->table.'.id AND uf.user_id = '.auth()->user()->id.') IS NOT NULL,true,false) as is_favorited'));
    }
  }

  public function scopeSelectCard($query)
  {
    return $query->select('id','is_active','is_approved','category_id','title','price','user_id','created_at','deleted_at')
    ->with('User')->selectRatingAverage();
  }

  public function scopeOnlyTopRated($query)
  {
    // return $query->whereNotNull('rating_avg')->orderBy('rating_avg','DESC');
    return $query;
  }

  public function scopeOnlyTopSelling($query)
  {
    // return $query->whereNotNull('rating_avg')->orderBy('rating_avg','DESC');
    return $query;
  }


  /**
   * Check if the users is authorized to manage the current service
   */
   public function scopeAuthorized($query)
   {
     return $query->where(function($qu){
       if (!auth()->user()->is_admin){
        $qu = $qu->where('user_id',auth()->user()->id);
       }
       return $qu;
     });
   }
}
