<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Helper;
use App\Models\Service,App\Models\Order,App\Models\User;

class UserOrderController extends Controller
{

    /**
     * Get orders list
     * 
     */
    public function getList()
    {
      $Orders = Order::with('Service');
      
      $Orders = $Orders->where('user_id',auth()->user()->id);
      $Orders = $Orders->paginate(50);
      return Helper::responseData('success',true,$Orders);
    }


}
