<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helper;
use App\Models\User;
use App\Models\Skill;
use App\Models\Order;
use App\Models\UserFavouriteService;
use App\Models\Conversation;
use App\Models\Service;
use App\Models\ServiceReview;

class UserProfileController extends Controller
{
    /**
     * Get user dashboard
     * 
     */
    public function getDashboard()
    {
      $getUserReviews = ServiceReview::selectRaw('COUNT(id) AS ratings_count,AVG(rating) AS rating_avg')->whereHas('Service',function($Service){
          return $Service->where('user_id',auth()->user()->id);
        })->first();
        if($getUserReviews){
          $userReviews = [
            'ratings_count' => $getUserReviews->ratings_count,
            'rating_avg' => floatval(number_format($getUserReviews->rating_avg,2))
          ];
        }else {
          $userReviews = [
            'ratings_count' => 0,
            'rating_avg' => 0
          ];
        }
        $User = auth()->user();
        $User->reviews = $userReviews;
      $Result = [
        'user' => $User
      ];


      $Balance = 0;

      $Statistics = [
        'submitted_services' => Service::where('user_id',auth()->user()->id)->count(),
        'buyers_count' => User::whereHas('Orders',function($Orders){
          return $Orders->whereHas('Service',function($Service){
            return $Service->where('user_id',auth()->user()->id);
          });
        })->count(),
        'balance' => $Balance
      ];

      $Result['new_orders'] = Order::authorized()->orderBy('created_at','DESC')->take(5)->get();
      $Result['new_conversations'] = Conversation::selectCard()->authorized()->orderBy('created_at','DESC')->take(5)->get();
      $Result['new_favourites'] = UserFavouriteService::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->take(5)->get();
      $Result['statistics'] = $Statistics;

//      return Helper::responseData('success',true,$Result);
      return view('site.user.dashboard.index')->with('result',$Result);
    }

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
//      return Helper::responseData('success',true,$User);
        return view('site.user.profile')->with('user',$User);
    }
    /**
     * Get specific user profile
     *
     * @param integer $userId
     */
    public function getMyProfile()
    {
        $userId = auth()->user()->id;
      $User = User::where('id',$userId)->with('LastDeliveredOrder')->first();
      if(!$User){
        return Helper::responseData('user_not_found',false,false,__('default.error_message.user_not_found'),404);
      }
      $Skills = Skill::whereHas('UserSkills',function($UserSkills) use($userId){
        return $UserSkills->where('user_id',$userId);
      })->selectCard()->get();
      $User->skills = $Skills;
//      return Helper::responseData('success',true,$User);
        return view('site.user.my_profile')->with('user',$User);
    }

    

}
