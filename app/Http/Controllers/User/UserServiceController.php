<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\User;
use Helper;

class UserServiceController extends Controller
{

    /**
     * Get services list
     * 
     * @param Request $q
     */
    public function getList(Request $q)
    {
        $Services = Service::selectCard();
        
        // By price range
        if (request()->price_min || request()->price_max) {
            if(request()->price_max){
                $Services = $Services->where('price','<=',request()->price_max);
            }
            if(request()->price_min){
                $Services = $Services->where('price','>=',request()->price_min);
            }
        }

        // By title
        if (request()->title) {
            $Services = $Services->where('title','LIKE','%'.request()->title.'%');
        }

        // By category
        if (request()->category_id || request()->category_slug) {
            $Services = $Services->whereHas('Category',function($Category){
                if(request()->category_slug){
                    return $Category->where('slug',request()->category_slug);
                }else {
                    return $Category->where('id',request()->category_id)->orWhere('parent_id',request()->category_id);
                }
            });
        }

        // Sorting data by
        if (request()->order_by && request()->order_by != 'all') {
            // Price Order
            if(strpos(request()->order_by,'price_') !== false){
                $price_sort = (request()->order_by == 'price_asc') ? 'asc' : 'desc';
                $Services = $Services->orderBy('price',$price_sort);
            }
        }else {
            $Services = $Services->orderBy('id','DESC');
        }

        $Services = $Services->paginate(50)->toArray();
        return Helper::responseData('success',true,$Services);
    }

    /**
     * Get service
     * 
     * @param integer $serviceId
     * @param Request $q
     */
    public function getShow($serviceId,Request $q)
    {
        $Service = Service::where('id',$serviceId)->authorized()->first();
        if($Service) {
            $Service = $Service->makeVisible('user_id','category_id','deleted_at','updated_at')->toArray();
            return Helper::responseData('success',true,$Service);
        }else {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }
    }

    /**
     * Save service
     * 
     * @param mixed $serviceId
     * @param Request $q
     */
    public function Save($serviceId = null,Request $q)
    {
        $validator = validator()->make($q->all(), [
            'title' => 'required|max:255',
            'is_active' => 'boolean',
        ]);
        if($validator->fails()) {
        return Helper::responseValidationError($validator->messages());
        }

        if($serviceId){
            $Service = Service::where('id',$serviceId)->authorized()->first();
        }else {
            $Service = new Service;
        }
        $Service->title = $q->title;
        $Service->is_active = ($q->is_active === false) ? 0 : 1;
        $Service->description = $q->description;
        $Service->save();

        return Helper::responseData('service_deleted',true,$Service,__('default.success_message.service_added'));
    }

    /**
     * Delete service
     * 
     * @param integer $serviceId
     * @param Request $q
     */
    public function Delete($serviceId,Request $q)
    {
        $Service = Service::where('id',$serviceId)->authorized()->first();
        if($Service) {
            $Service = $Service->delete();
            return Helper::responseData('service_deleted',true,false,__('default.success_message.service_deleted'));
        }else {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }
    }
}
