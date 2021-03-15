<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\UploaderController;
use App\Notifications\NewMessageConversationNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Helper;
use App\Models\Service,App\Models\Conversation,App\Models\ConversationMessage,App\Models\User;

class UserConversationController extends Controller
{

    /**
     * Send message to service provider
     *
     * @param Request $q
     */
    public function postSendMessage(Request $q)
    {

        $validator = validator()->make($q->all(), [
          'service_provider_id' => ['required',new \App\Rules\UserRule],
          'message' => 'required',
            'attachment' => 'nullable'
        ]);
        if($validator->fails()) {
          return Helper::responseValidationError($validator->messages());
        }


        $Conversation = new Conversation;
        $Conversation->title = "q->title";
        $Conversation->user_sender_id = auth()->user()->id;
        $Conversation->user_recipient_id = $q->service_provider_id;
        $Conversation->save();

        $ConversationMessage = new ConversationMessage;
        $ConversationMessage->conversation_id = $Conversation->id;
        $ConversationMessage->user_id = auth()->user()->id;
        $ConversationMessage->message = $q->message;

        $upload = new UploaderController();
        $upload->folder = 'messages';
        $upload->thumbFolder = 'messages/thumbs';
        $galleryItemResponse = $q->hasFile('attachment') ? $upload->uploadSingle($q->attachment,false) : null;
        $ConversationMessage->attachments = $galleryItemResponse ? $galleryItemResponse['path'] : null;
        $ConversationMessage->save();

        $Conversation = Conversation::selectCard()->where('id',$Conversation->id)->first();

        $toUser = User::find($q->service_provider_id);
        $toUser->notify(new NewMessageConversationNotification(auth()->user()));

        return Helper::responseData('success',true,$Conversation);
    }

    /**
     * Get conversations list
     *
     */
    public function getList()
    {
      $Conversations = Conversation::selectCard()->authorized()->orderBy('id','DESC')->paginate(50);
//      return Helper::responseData('success',true,$Conversations);
      // return response($Conversations, 200);
       return view('site.user.dashboard.messages')->with('conversations',$Conversations);
    }

    /**
     * Get conversation messages
     *
     * @param integer $conversationId
     */
    public function getMessages($conversationId , Request $q)
    {
      $validator = validator()->make($q->all(), [
        'conversation_id' => 'required'
      ]);
      // if($validator->fails()) {
      //   return Helper::responseValidationError($validator->messages());
      // }
      $conversationId = $q->conversation_id;
      // Check conversation
      $Conversation = Conversation::authorized()->where('id',$conversationId)->first();
      if(!$Conversation){
        return Helper::responseData('conversation_not_found',false,false,__('default.error_message.conversation_not_found'),404);
      }

      $ConversationMessages = ConversationMessage::where('conversation_id',$conversationId)->with('User')->paginate(50);
      return Helper::responseData('success',true,$ConversationMessages);
    }

    /**
     * Send reply to conversation
     *
     * @param integer $conversationId
     */
    public function postSendReply(Request $q)
    {
      $validator = validator()->make($q->all(), [
        'conversation_id' => 'required',
        'message' => 'required',
        // 'attachments' => 'array'
      ]);
      // if($validator->fails()) {
      //   return Helper::responseValidationError($validator->messages());
      // }
      $conversationId = $q->conversation_id;
      // Check conversation
      $Conversation = Conversation::authorized()->where('id',$conversationId)->first();
      if(!$Conversation){
        return Helper::responseData('conversation_not_found',false,false,__('default.error_message.conversation_not_found'),404);
      }

      $ConversationMessage = new ConversationMessage;
      $ConversationMessage->conversation_id = $Conversation->id;
      $ConversationMessage->user_id = auth()->user()->id;
      $ConversationMessage->message = $q->message;

        $upload = new UploaderController();
        $upload->folder = 'messages';
        $upload->thumbFolder = 'messages/thumbs';
        $galleryItemResponse = $q->hasFile('attachment') ? $upload->uploadSingle($q->attachment,false) : null;
        $ConversationMessage->attachments = $galleryItemResponse ? $galleryItemResponse['path'] : null;

      $ConversationMessage->save();

      $ConversationMessage = ConversationMessage::where('id',$ConversationMessage->id)->with('User')->first();
      return Helper::responseData('success',true,$ConversationMessage);
    }

}
