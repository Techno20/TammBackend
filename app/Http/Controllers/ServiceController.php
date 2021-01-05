<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\User;
use Helper;

class ServiceController extends Controller
{
    /**
     * Get service details
     * 
     * @param integer $serviceId
     * @param Request $q
     */
    public function getShow($serviceId,Request $q)
    {
        $Service = Service::where('id',$serviceId)->select('*')->selectRatingAverage()->selectIsFavorited()->with(['Gallery','Category','User' => function($User){
            return $User->addSelect('about_me');
        }]);
        if(auth()->user() && !auth()->user()->is_admin){
            $Service = $Service->where(function($qu){
                return $qu->where([['is_approved',1],['is_active',1]])->orWhere('user_id',auth()->user()->id);
            });
        }
        $Service = $Service->first();
        if($Service) {
            return Helper::responseData('success',true,$Service);
        }else {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }
    }

    /**
     * Get Services List
     */
    public function getList(){
        $validator = validator()->make(request()->all(), [
            'main_category_type' => [new \App\Rules\MainCategoryTypeRule],
            'user_id' => 'integer',
            'category_id' => 'integer',
            'price_min' => 'numeric',
            'price_max' => 'numeric'
        ]);
        if($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }

        $Services = Service::onlyApproved()->onlyActive()->selectCard();

        /* Filters */

        // By main category type
        if (request()->main_category_type) {
            $Services = $Services->where('main_category_type',request()->main_category_type);
        }

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
        if (request()->category_id) {
            $Services = $Services->where('category_id',request()->category_id);
        }

        // By user
        if (request()->user_id) {
            $Services = $Services->where('user_id',request()->user_id);
        }

        // Sorting data by
        if (request()->order_by && request()->order_by != 'all') {
            // Price Order
            if(strpos(request()->order_by,'price_') !== false){
                $price_sort = (request()->order_by == 'price_asc') ? 'asc' : 'desc';
                $Services = $Services->orderBy('price',$price_sort);
            }elseif(request()->order_by == 'top_rating'){
                $Services = $Services->orderByTopRated();
            }elseif(request()->order_by == 'top_selling'){
                $Services = $Services->orderByTopSelling();
            }
        }else {
            $Services = $Services->orderBy('id','DESC');
        }

        $Services = $Services->paginate(50)->toArray();

        return Helper::responseData('success',true,$Services);
    }

    /**
     * Get Service Reviews
     * 
     * @param integer $serviceId
     */
    public function getReviews($serviceId){
        $serviceReviews = ServiceReview::where('service_id',$serviceId)->selectCard();

        /* Filters */
        // Sorting data by
        if (request()->order_by && request()->order_by != 'all') {
            // Rating Order
            if(strpos(request()->order_by,'rating_') !== false){
                $sort = (request()->order_by == 'rating_asc') ? 'asc' : 'desc';
                $serviceReviews = $serviceReviews->orderBy('rating',$sort);
            }elseif(strpos(request()->order_by,'date_') !== false){
                $sort = (request()->order_by == 'date_asc') ? 'asc' : 'desc';
                $serviceReviews = $serviceReviews->orderBy('created_at',$sort);
            }
        }else {
            $serviceReviews = $serviceReviews->orderBy('id','DESC');
        }

        $serviceReviews = $serviceReviews->paginate(50)->toArray();

        return Helper::responseData('success',true,$serviceReviews);
    }

    /**
     * Get home data
     * 
     * @param Request $q
     */
    public function getHomeData(Request $q)
    {
        $result = [];
        // Statistics
        $result['statistics'] = [
            'services_count' => Service::onlyActive()->onlyApproved()->count(),
            'users_count' => User::whereDoesntHave('Services')->count(),
            'service_providers_count' => User::whereHas('Services')->count()
        ];

        // Top Rated Services
        $topRatedServices = Service::selectCard()->orderByTopRated()->take(32)->get();
        $result['top_rated_services'] = $topRatedServices;

        // Top Selling Services
        $topSellingServices = Service::selectCard()->orderByTopSelling()->take(32)->get();
        $result['top_selling_services'] = $topSellingServices;

        return Helper::responseData('success',true,$result);
    }



}
