<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper, Storage;
class ConversationMessage extends Model
{
    protected $table = 'conversations_messages';
    protected $hidden = ['updated_at'];
    protected $appends = [
        'is_sender_me'
    ];

    /* START RELATIONS */


    // Conversation
    public function Conversation(){
        return $this->belongsTo('App\Models\Conversation');
    }

    // User
    public function User(){
        return $this->belongsTo('App\Models\User')->selectCard();
    }

    /* START ATTRIBUTES */

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s',strtotime($value));
    }

    /**
     * Get attachments
     *
     */
//    public function getAttachmentsAttribute($value){
//        $fullPathAttachments = [];
//        if($value){
//            $Attachments = explode('||',$value);
//            if(is_array($Attachments) && count($Attachments)){
//                foreach($Attachments as $Attachment){
//                    $fullPathAttachments[] = Storage::url('attachments/'.$Attachment);
//                }
//            }
//        }
//        return $fullPathAttachments;
//    }

    /**
     * Set attachments
     *
     */
//    public function setAttachmentsAttribute($value){
//        $this->attributes['attachments'] = join('||',Helper::cleanArraySeperator($value,'||'));
//    }


    // Check whether the sender is the current user
    public function getIsSenderMeAttribute(){
        $isMe = false;
        if(auth()->user()->id == $this->user_id){
            $isMe = true;
        }
        return $isMe;
    }

    public function getMessageAttachmentUrl()
    {
        return 'storage/messages/' . $this->attachments;
    }
}
