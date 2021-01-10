<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper;
class Conversation extends Model
{
    protected $appends = [
        'is_sender_me'
    ];

    protected $hidden = ['updated_at'];
    
    /* START RELATIONS */


    // Messages
    public function Messages(){
        return $this->hasMany('App\Models\ConversationMessage');
    }

    // Last Message
    public function LastMessage(){
        return $this->hasOne('App\Models\ConversationMessage')->orderBy('created_at');
    }

    // Sender
    public function Sender(){
        return $this->belongsTo('App\Models\User','user_sender_id','id')->selectCard();
    }

    // Recipient
    public function Recipient(){
        return $this->belongsTo('App\Models\User','user_recipient_id','id')->selectCard();
    }

    /* START ATTRIBUTES */

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }
    
    // Check whether the sender is the current user
    public function getIsSenderMeAttribute(){
        $isMe = false;
        if(auth()->user()->id == $this->user_sender_id){
            $isMe = true;
        }
        return $isMe;
    }


    /* START SCOPES */

   public function scopeSelectCard($query)
   {
        return $query->with('Sender','Recipient');
   }

  /**
   * Check if the users is authorized to manage the current order
   */
   public function scopeAuthorized($query)
   {
        return $query->where(function($qu){
            return $qu->where('user_sender_id',auth()->user()->id)->orWhere('user_recipient_id',auth()->user()->id);
        });
   }
}
