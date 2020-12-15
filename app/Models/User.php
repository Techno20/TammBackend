<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB,Helper;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    
    /**
     * Table name
     * 
     * Note: here we used merchants table instead of users table
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'auth_facebook',
        'auth_google',
        'is_admin',
        'is_admin_permissions',
        'password_reset_code',
        'password_reset_expire_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_reset_expire_at' => 'datetime'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /* START RELATIONS */

    // Favourite Services
    public function FavouriteServices(){
        return $this->hasManyThrough('App\Models\Service','App\Models\UserFavouriteService','user_id','id','id','service_id')->selectCard();
    }

    // Services
    public function Services(){
        return $this->hasMany('App\Models\Service');
    }

    // Orders
    public function Orders(){
        return $this->hasMany('App\Models\Order');
    }

    // Last Delivered Order
    public function LastDeliveredOrder(){
        return $this->hasOne('App\Models\Order')->select('id','user_id',DB::raw('status_updated_at AS delivered_at'))->where('status','delivered')->orderBy('status_updated_at','DESC');
    }

    // Skills
    public function Skills(){
        return $this->hasManyThrough('App\Models\Skill','App\Models\UserSkill','user_id','id','id','skill_id')->selectCard();
    }

    /* START ATTRIBUTES */

    /**
     * Get user avatar attribute
     * 
     * @return string
     */
    public function getAvatarFullPathAttribute()
    {
        if ($this->avatar) {
            $avatar = Storage::url('users/avatars/'.$this->image);
        }else {
            $avatar = asset('assets/images/no-avatar.png');
        }
        return $avatar;
    }


    /**
     * Get educations
     * 
     */
    public function getEducationsAttribute($value){
        return ($value) ? explode('||',$value) : [];
    }

    /**
     * Set educations
     * 
     */
    public function setEducationsAttribute($value){
        $this->attributes['educations'] = join('||',Helper::cleanArraySeperator($value,'||'));
    }

    /* START SCOPES */
    public function scopeSelectCard($query)
    {
        return $query->select('id','avatar','name','phone','email','fcm_token');
    }

}
