<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB,Helper,Storage;

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
        'deleted_at',
        'balance'
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

    protected $appends = ['avatar_full_path'];

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

    // Financial Transactions
    public function FinancialTransaction(){
        return $this->hasMany('App\Models\FinancialTransaction');
    }

    // Services Reviews
    public function ServicesReviews(){
        return $this->hasManyThrough('App\Models\Service','App\Models\ServiceReview','user_id','id','id','service_id');
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
    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }


    /**
     * Get user avatar attribute
     * 
     * @return string
     */
    public function getAvatarFullPathAttribute()
    {
        if ($this->avatar) {
            $avatar = Storage::url('users/avatars/'.$this->avatar);
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

    /**
     * Prepare total spending format
     */
    public function getTotalSpendingAttribute($value){
        return json_decode($value);
    }

    /* START SCOPES */
    public function scopeSelectCard($query)
    {
        return $query->select('id','avatar','name','email');
    }

    /**
     * Prepare orders count and total spend amount
     */
    public function scopeWithTotalSpending($query)
    {
        return $query->withCount(['Orders AS total_spending' => function($orders_amount){
            return $orders_amount->select(DB::raw('JSON_OBJECT("count",IFNULL(COUNT(id),0),"amount",IFNULL(SUM(paid_total),0)) as total_spending'));
        }]);
    }

    /**
     * Prepare users transactions profit
     */
    public function scopeWithTotalProfit($query)
    {
        return $query->addSelect(DB::raw('IFNULL((SELECT SUM(amount) FROM financial_transactions ft WHERE ft.user_id = '.$this->table.'.id AND ft.type = "profit" GROUP BY ft.user_id),0) AS total_profit_amount'));
    }
    
}
