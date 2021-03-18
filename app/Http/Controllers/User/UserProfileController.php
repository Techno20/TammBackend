<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\Account\UpdatePasswordRequest;
use App\Models\Bank;
use App\Models\Country;
use App\Models\Setting;
use Carbon\Carbon;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Session;

class UserProfileController extends Controller
{

    public function makeAllUserNotificationsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
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

        $clientsOrders = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('current')->orderBy('created_at', 'DESC')->take(5)->get();

        $clientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->where('status', '!=', 'canceled')->whereMonth('created_at', Carbon::now()->month)->count();

        $clientsOrdersPaidCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('delivered')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth()->subMonth(3), Carbon::now()])
            ->sum('paid_total');

        $clientsOrdersTotalPaidCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('delivered')
            ->sum('total_after_commission');

        $allClientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        });

        $currentClientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('current')->count();

        $deliveredClientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('delivered')->count();

        $cancelledClientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->whereStatus('canceled')->count();

        $allClientsOrdersCount = Order::with('Service')->whereHas('Service', function ($Service) {
            return $Service->where('user_id', auth()->user()->id);
        })->count();


        return view('site.user.dashboard.index')->with(['result' => $Result , 'clientsOrders' => $clientsOrders , 'clientsOrdersCount' => $clientsOrdersCount
          , 'clientsOrdersPaidCount' => $clientsOrdersPaidCount , 'clientsOrdersTotalPaidCount' => $clientsOrdersTotalPaidCount
            , 'currentClientsOrdersCount' => $currentClientsOrdersCount , 'deliveredClientsOrdersCount' => $deliveredClientsOrdersCount ,
            'cancelledClientsOrdersCount' => $cancelledClientsOrdersCount , 'allClientsOrdersCount' => $allClientsOrdersCount]);
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
//      dd($User->toArray());
//      return Helper::responseData('success',true,$User);
        $Services = Service::selectCard()
            ->where('user_id',$userId)
            ->with('Category')
            ->orderBy('id','DESC')
            ->paginate(6);
        return view('site.user.profile')->with('user',$User)->with('services',$Services);
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
        $Services = Service::selectCard()
            ->where('user_id',auth()->user()->id)
            ->with('Category')
            ->orderBy('id','DESC')
            ->paginate(5);
        return view('site.user.my_profile')->with('user',$User)->with('services',$Services);
    }

    public function getMyProfileupdat()
    {
        $userId = auth()->user()->id;
        $User = User::where('id',$userId)->with('LastDeliveredOrder')->first();
        if(!$User){
            return Helper::responseData('user_not_found',false,false,__('default.error_message.user_not_found'),404);
        }
//        $Skills = Skill::whereHas('UserSkills',function($UserSkills) use($userId){
//            return $UserSkills->where('user_id',$userId);
//        })->selectCard()->get();
//        $User->skills = $Skills;

        $allSkills = Skill::selectCard()->get();
        $userSkills = $User->user_skills;

        $countries = Country::selectcard()->get();
        $banks = Bank::selectcard()->get();

//      return Helper::responseData('success',true,$User);
        $Services = Service::selectCard()
            ->where('user_id',auth()->user()->id)
            ->with('Category')
            ->orderBy('id','DESC')
            ->paginate(5);
        return view('site.user.EditmyProfile')->with(['user' => $User , 'services' => $Services ,
            'allSkills' => $allSkills , 'userSkills' => $userSkills , 'countries' => $countries
            , 'banks' => $banks]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        if(Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('success' , Lang::get('site.password_updated'));
            return redirect()->back();
        }else
        {
            Session::flash('error' , Lang::get('site.old_password_incorrect'));
            return redirect()->back();
        }
    }


}
