<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helper;
use App\Models\User;
use App\Models\Skill;

class UserProfileController extends Controller
{

    /**
     * Get specific user profile
     * 
     * @param integer $userId
     */
    public function getProfile($userId)
    {
      $User = User::where('id',$userId)->with('LastDeliveredOrder')->first();
      if(!$User){
        return Helper::responseData('user_not_found',false,false,__('default.error_message.user_not_found'),404);
      }
      $Skills = Skill::whereHas('UserSkills',function($UserSkills) use($userId){
        return $UserSkills->where('user_id',$userId);
      })->selectCard()->get();
      $User->skills = $Skills;
      return Helper::responseData('success',true,$User);
    }

    

}
