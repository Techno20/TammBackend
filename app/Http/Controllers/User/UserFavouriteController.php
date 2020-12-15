<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Helper;
use App\Models\Service,App\Models\UserFavouriteService,App\Models\User;

class UserFavouriteController extends Controller
{

    /**
     * Get favourites list
     * 
     */
    public function getList()
    {
      $FavouriteList = auth()->user()->FavouriteServices()->paginate(50);
      return Helper::responseData('success',true,$FavouriteList);
    }

    /**
     * Add service to favourite
     * @param Request $q 
     */
    public function postAddService($serviceId,Request $q)
    {
      $Service = Service::where('id',$serviceId)->onlyApproved()->onlyActive()->count();
      if(!$Service){
        return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
      }
      $UserFavouriteService = UserFavouriteService::firstOrCreate(['service_id' => $serviceId,'user_id' => auth()->user()->id]);

      return Helper::responseData('success',true);
    }

    /**
     * Remove service from favourite
     * @param Request $q 
     */
    public function deleteService($serviceId,Request $q)
    {
      $UserFavouriteService = UserFavouriteService::where([['user_id',auth()->user()->id],['service_id',$serviceId]])->first();
      if(!$UserFavouriteService){
        return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
      }
      $UserFavouriteService->delete();
      return Helper::responseData('success',true);
    }
    

}
