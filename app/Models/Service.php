<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Storage,Helper;

class Service extends Model
{

  protected $table = 'services';

  protected $casts = [
    'category_id' => 'integer',
    'user_id' => 'integer',
    'is_approved' => 'boolean',
    'is_active' => 'boolean'
  ];

  protected $appends = [
    'main_category_type_string'
  ];

  protected $hidden = [
    'user_id','category_id','deleted_at','updated_at'
  ];

  protected $guarded = [
    'id'
  ];

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
   * Get meta description
   */
  public function getMetaDescriptionAttribute(){
    return substr($this->description,0,160);
  }


  /**
   * Get basic services list
   *
   */
  public function getBasicServicesListAttribute($value){
      return ($value) ? explode('||',$value) : [];
  }

  /**
   * Set basic services list
   *
   */
  public function setBasicServicesListAttribute($value){
      $this->attributes['basic_services_list'] = join('||',Helper::cleanArraySeperator($value,'||'));
  }

  /**
   * Get standard services list
   *
   */
  public function getStandardServicesListAttribute($value){
      return ($value) ? explode('||',$value) : [];
  }

  /**
   * Set standard services list
   *
   */
  public function setStandardServicesListAttribute($value){
      $this->attributes['standard_services_list'] = join('||',Helper::cleanArraySeperator($value,'||'));
  }

  /**
   * Get premium services list
   *
   */
  public function getPremiumServicesListAttribute($value){
      return ($value) ? explode('||',$value) : [];
  }

  /**
   * Set premium services list
   *
   */
  public function setPremiumServicesListAttribute($value){
      $this->attributes['premium_services_list'] = join('||',Helper::cleanArraySeperator($value,'||'));
  }

  /* START RELATIONS */
  // Image
  public function Image(){
    return $this->hasOne('App\Models\ServiceGallery')->select('id','service_id','path');
    // ->whereRaw('path REGEXP "^.(jpg|jpeg|png|bmp|gif)(?:[\?\#].*)?$"');
  }

  // Gallery
  public function Gallery(){
    return $this->hasMany('App\Models\ServiceGallery')->select('id','service_id','path');
  }

  // Category
  public function Category(){
    return $this->belongsTo('App\Models\Category')->select('id',DB::raw('name_'.app()->getLocale().' as name'));
  }

  // User
  public function User(){
    return $this->belongsTo('App\Models\User','user_id','id')->selectCard()->withTrashed();
  }

  // Extra Services
  public function Extras(){
    return $this->hasMany('App\Models\ServiceExtra');
  }

  // Reviews
  public function Reviews(){
    return $this->hasMany('App\Models\ServiceReview');
  }

  // Orders
  public function Orders(){
    return $this->hasMany('App\Models\Order');
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
    return $query->select(DB::raw($this->table.'.id'),DB::raw($this->table.'.is_active'),DB::raw($this->table.'.is_approved'),DB::raw($this->table.'.category_id'),DB::raw($this->table.'.main_category_type'),DB::raw($this->table.'.title'),DB::raw($this->table.'.description'),DB::raw($this->table.'.basic_price'),DB::raw($this->table.'.user_id'),DB::raw($this->table.'.created_at'),DB::raw($this->table.'.deleted_at'))
    ->with('User','Image')->selectRatingAverage();
  }

  public function scopeOrderByTopRated($query)
  {
    return $query->leftJoin(DB::raw('(SELECT AVG(rating) AS rating,service_id FROM services_reviews GROUP BY service_id) AS services_reviews_avg'),'services_reviews_avg.service_id','=','services.id')->orderBy('services_reviews_avg.rating','DESC');
  }

  public function scopeOrderByTopSelling($query)
  {
    return $query->orderBy(DB::raw('(SELECT COUNT(o.id) FROM orders o WHERE o.service_id = '.$this->table.'.id)'),'DESC');
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

   public function getAverageServiceRating()
   {
       if($this->Reviews()->count() == 0)
           return 0;
       else
           return round($this->Reviews()->sum('rating') / $this->Reviews()->count() , 1);
   }
}
