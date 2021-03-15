<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB,Helper,Storage;
use App\Models\FinancialTransaction;

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
    // Orders
    public function CompleteOrders(){
        return $this->hasMany('App\Models\Order')->where('status','delivered');
    }

    // Last Delivered Order
    public function LastDeliveredOrder(){
        return $this->hasOne('App\Models\Order')->select('id','user_id',DB::raw('status_updated_at AS delivered_at'))->where('status','delivered')->orderBy('status_updated_at','DESC');
    }

    // Skills
    public function Skills(){
        return $this->hasManyThrough('App\Models\Skill','App\Models\UserSkill','user_id','id','id','skill_id')->selectCard();
    }

    public function user_skills()
    {
        return $this->hasMany(UserSkill::class );
    }

    // Bank
    public function Bank(){
        return $this->belongsTo('App\Models\Bank')->selectCard();
    }
    // Bank
    public function Country(){
        return $this->belongsTo('App\Models\Country')->selectCard();
    }

    /* START ATTRIBUTES */
//    public function getCreatedAtAttribute($value){
//        return date('Y-m-d H:i:s',strtotime($value));
//    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    /**
     * Get is admin permissions as object
     */
    public function getIsAdminPermissionsAttribute($value){
        return ($value) ? json_decode($value) : null;
    }

    /**
     * Get user avatar attribute
     *
     * @return string
     */
    public function getAvatarFullPathAttribute()
    {
        if ($this->avatar && Storage::exists('users/avatars/'.$this->avatar)) {
            $avatar = Storage::url('users/avatars/'.$this->avatar);
        }else {
//            $avatar = asset('assets/images/no-avatar.png');
            $avatar = asset('assets/site/images/user.png');
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
        return $query->select('id','avatar','name','email' , 'created_at');
    }

    /**
     * Prepare orders count and total spend amount
     */
    public function scopeWithTotalSpending($query)
    {
        return $query->withCount(['Orders AS total_spending' => function($orders_amount){
            return $orders_amount->where('status','!=','canceled')->select(DB::raw('JSON_OBJECT("count",IFNULL(COUNT(id),0),"amount",IFNULL(SUM(paid_total),0)) as total_spending'));
        }]);
    }

    /**
     * Prepare users transactions profit
     */
    public function scopeWithTotalProfit($query)
    {
        return $query->addSelect(DB::raw('IFNULL((SELECT SUM(amount) FROM financial_transactions ft WHERE ft.user_id = '.$this->table.'.id AND ft.type = "profit" GROUP BY ft.user_id),0) AS total_profit_amount'));
    }

    /**
     * Log financial transaction and this function do so:
     * Generate different types of financial transactions such as Deposit, Withdraw, Profit, Charge and Refund.
     *
     * @param array $transactionDetails
     */
    public static function logFinancialTransaction($transactionDetails = []){
        if(isset($transactionDetails['user_id']) && isset($transactionDetails['type'])){
            $FinancialTransaction = new FinancialTransaction;
            $FinancialTransaction->user_id = $transactionDetails['user_id'];
            $FinancialTransaction->no = md5(uniqid(rand(), true));
            $FinancialTransaction->type = $transactionDetails['type'];
            $FinancialTransaction->amount = (isset($transactionDetails['amount'])) ? $transactionDetails['amount'] : 0;
            $FinancialTransaction->order_id = (isset($transactionDetails['order_id'])) ? $transactionDetails['order_id'] : null;
            $FinancialTransaction->service_id = (isset($transactionDetails['service_id'])) ? $transactionDetails['service_id'] : null;
            $FinancialTransaction->save();
            User::logTransactionUpdateBalance($FinancialTransaction->user_id,$FinancialTransaction->type,$FinancialTransaction->amount);

        }
    }

    /**
     * Update user balance after logging the transaction
     *
     * @param integer $userId
     * @param string $transactionType
     * @param integer $amount
     */
    private static function logTransactionUpdateBalance($userId,$transactionType,$amount){
        if($transactionType != 'charge'){
            // Update User Balance
            $User = User::where('id',$userId)->select('id','balance')->first();
            if($transactionType == 'withdraw'){
                $User->balance = $User->balance - $amount;
            }
            if(in_array($transactionType,['refund','profit'])){
                $User->balance = $User->balance + $amount;
            }
            if($User->balance < 0){
                $User->balance = 0;
            }
            $User->save();
        }
    }

    public function getUserServicesReviews()
    {
        if($this->ServicesReviews()->count() == 0)
            return 0;
        else
            return round($this->ServicesReviews()->sum('rating') / $this->ServicesReviews()->count() , 1);
    }

    public function getJoiningAt()
    {
        return Carbon::parse($this->created_at)->format('Y-m');
    }
}
