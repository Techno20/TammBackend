<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper, Storage;
class Order extends Model
{
    protected $appends = ['order_no','status_string','package_string','commission_amount','net_amount'];

    /* START RELATIONS */

    // Service
    public function Service(){
        return $this->belongsTo('App\Models\Service')->selectCard();
    }

    // User
    public function User(){
        return $this->belongsTo('App\Models\User')->selectCard();
    }

    // Extras
    public function Extras(){
        return $this->hasMany('App\Models\OrderExtra')->with('Extra');
    }

    /* START ATTRIBUTES */

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    /**
     * Get order no
     *
     */
    public function getOrderNoAttribute(){
        return 'T'.$this->id;
    }

    /**
     * Get status as string
     *
     */
    public function getStatusStringAttribute(){
        return __('default.other.order_status.'.$this->status);
    }

    /**
     * Get package as string
     *
     */
    public function getPackageStringAttribute(){
        return __('default.other.package.'.$this->package);
    }

    /**
     * Get requirements attachments
     *
     */
//    public function getRequirementsAttachmentsAttribute($value){
//        if($value){
//            $result = [];
//            $exp = explode('||',$value);
//            foreach($exp as $exp_item){
//                $result[] = [
//                    'file_name' => $exp_item,
//                    'full_path' => Storage::url('attachments/'.$exp_item)
//                ];
//            }
//            return $result;
//        }else {
//            return [];
//        }
//    }

    /**
     * Set requirements attachments
     *
     */
//    public function setRequirementsAttachmentsAttribute($value){
//        $this->attributes['requirements_attachments'] = join('||',Helper::cleanArraySeperator($value,'||'));
//    }

    /**
     * Get service delivery attachments
     *
     */
//    public function getServiceDeliveryAttachmentsAttribute($value){
//        if($value){
//            $result = [];
//            $exp = explode('||',$value);
//            foreach($exp as $exp_item){
//                $result[] = [
//                    'file_name' => $exp_item,
//                    'full_path' => Storage::url('attachments/'.$exp_item)
//                ];
//            }
//            return $result;
//        }else {
//            return [];
//        }
//    }

    /**
     * Set service delivery attachments
     *
     */
//    public function setServiceDeliveryAttachmentsAttribute($value){
//        $this->attributes['service_delivery_attachments'] = join('||',Helper::cleanArraySeperator($value,'||'));
//    }

    /**
     * Commission Amount Attribute
     *
     */
    public function getCommissionAmountAttribute(){
        return $this->paid_total*(0.01*$this->commission_rate);
    }

    /**
     * Net Amount Attribute
     *
     */
    public function getNetAmountAttribute(){
        return $this->paid_total-($this->paid_total*(0.01*$this->commission_rate));
    }


  /**
   * Check if the users is authorized to manage the current order
   */
   public function scopeAuthorized($query)
   {
        return $query->where(function($qu){
            return $qu->whereHas('Service',function($Service){
                return $Service->where('user_id',auth()->user()->id);
            })->orWhere('user_id',auth()->user()->id);
        });
   }

   public function getRequirementsAttachmentsURL()
   {
       return 'storage/orders/' . $this->requirements_attachments;
   }

    public function getServiceDeliveryAttachmentsURL()
    {
        return 'storage/orders/delivered/' . $this->service_delivery_attachments;
    }

}
