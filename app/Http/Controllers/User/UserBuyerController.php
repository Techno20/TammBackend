<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Helper;
use App\Models\Service,App\Models\UserFavouriteService,App\Models\User;

class UserBuyerController extends Controller
{

    /**
     * Get buyers list
     * 
     */
    public function getList()
    {
      $Buyers = User::selectCard()->whereHas('Orders',function($Orders){
        return $Orders->whereHas('Service',function($Service){
          return $Service->where('user_id',auth()->user()->id);
        });
      })->withCount(['Orders' => function($Orders){
        return $Orders->whereHas('Service',function($Service){
          return $Service->where('user_id',auth()->user()->id);
        });
      }])->paginate(50);
      return Helper::responseData('success',true,$Buyers);
    }

    

}
