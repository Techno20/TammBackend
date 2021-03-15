<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HowWeWork;
use App\Models\Order;
use App\Models\OrderExtra;
use App\Models\Say;
use App\Models\ServiceExtra;
use App\Models\Setting;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\User;
use Helper;
use Illuminate\Support\Facades\DB;

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
            $result['category'] = Category::selectCard()->find($Service->category_id);
            $result['main_categories'] = $this->getMainCategoriesType();
//            return Helper::responseData('success',true,$Service);
            return view('site.services.show')->with('service',$Service)->with('result',$result);
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

        $result = [];
        // By category
        if (request()->category_id) {
            $Services = $Services->where('category_id',request()->category_id);
            $result['category'] = Category::selectCard()->find(request()->category_id);
            $result['main_categories'] = $this->getMainCategoriesType();
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

        $Services = $Services->where('is_approved',1)->paginate(20);


//        return Helper::responseData('success',true,$Services);
        return view('site.services.list')->with('services',$Services)->with('result',$result);
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
        $topRatedServices = Service::onlyApproved()
            ->onlyActive()->selectCard()->orderByTopRated()->take(32)->get();
        $result['top_rated_services'] = $topRatedServices;

        // Top Rated seller
//        $topRatedSeller = Service::selectCard()->orderByTopRated()->groupBy('user_id')->take(32)->get();
        $topRatedSeller = Service::onlyApproved()
            ->onlyActive()->selectCard()->orderByTopRated()->take(32)->get();
        $result['top_rated_seller'] = $topRatedSeller;

        // Top Selling Services
        $topSellingServices = Service::onlyApproved()
            ->onlyActive()->selectCard()->orderByTopSelling()->take(32)->get();
        $result['top_selling_services'] = $topSellingServices;

        // Top Selling Services
        $categories = Category::selectCard()->take(32)->get();
        $result['categories'] = $categories;

        $says = Say::where('status',1)->where('lang',app()->getLocale())->limit(5)->get();
        $result['says'] = $says;

        $how_we_work = HowWeWork::where('status',1)->where('lang',app()->getLocale())->limit(3)->get();
        $result['how_we_work'] = $how_we_work;

        return view('site.pages.home')->with('result',$result);
//        return Helper::responseData('success',true,$result);
    }

    public function getCategories($main_category = null,Request $request)
    {
        $main_categories_type_arabic = $this->getMainCategoriesType();
        $result = [];
        // Categories Lis
        $categories = Category::selectCard();
        if(isset($main_category) && !empty($main_category) && in_array($main_category,array_keys($main_categories_type_arabic)) && $main_category !='all'){
            $categories = $categories->where('main_category_type',$main_category);
            $result['main_category_type'] = $main_category;
        }
        $result['categories'] = $categories->get();
        $result['main_categories'] = $main_categories_type_arabic;
        return view('site.services.categories')->with('result',$result);
    }


    public function getMainCategoriesType(){
        return ['all'=>'جميع الخدمات','technical' => 'تقنية','consultation' => 'استشارات','training' => 'تدريب'];
    }


    public function payment_response(Request $request){
        $response = Helper::payment_response($request['tap_id']);
        $q = session('checkout');
        if (isset($response['status']) && $response['status'] == 'CAPTURED' && isset($q['service_id']) && isset($q['package'])) {
            DB::beginTransaction();
            $Service = Service::where('id',$q['service_id'])->first();
            $paidTotal = 0;

            // Subtract package price
            $Package = isset($q['package']) && ($q['package'] && $q['package'] != 'basic') ? $q['package'] : 'basic';
            $paidTotal += $Service->{$Package.'_price'};

            // Subtract extra services prices
            if(isset($q['extra_services']) && is_array($q['extra_services']) && count($q['extra_services'])){
                $insertOrderExtraServices = [];
                foreach($q['extra_services'] as $extraServiceId){
                    // Get extra service price
                    $getExtraService = ServiceExtra::where([['id',$extraServiceId],['service_id',$q['service_id']]])->first();
                    if($getExtraService){
                        // Subtract extra service price
                        $paidTotal += $getExtraService->price;
                        $insertOrderExtraServices[] = [
                            'order_id' => $getExtraService->service_id,
//                        'service_id' => $getExtraService->service_id,
                            'services_extra_id' => $getExtraService->id,
                            'pay_total' => $getExtraService->price
                        ];
                    }
                }
                // Save extra services to current order
                if(count($insertOrderExtraServices)){
                    OrderExtra::insert($insertOrderExtraServices);
                }
            }

            // Get commission rate from setting
            $commissionRate = Setting::select('commission_rate')->first()->commission_rate;

            $Order = new Order;
            $Order->user_id = auth()->user()->id;
            $Order->service_id = $Service->id;
            $Order->package = $Package;
            $Order->paid_total = $paidTotal;
            $Order->commission_rate = $commissionRate;
            $Order->requirements_details = isset($q['requirements_details']) ? $q['requirements_details'] : null;

            $upload = new UploaderController();
            $upload->folder = 'orders';
            $upload->thumbFolder = 'orders/thumbs';
            $galleryItemResponse = session()->has('checkout_file') ? session('checkout_file') : null;
            $Order->requirements_attachments = $galleryItemResponse ? $galleryItemResponse['path'] : null;
            $Order->save();

            $user = $Service->User;
            $user->notify(new NewOrderNotification(auth()->user() , $Order));

            /**
             * Log a financial transaction for both order submitter and service provider
             */
            User::logFinancialTransaction(
                [
                    'user_id' => auth()->user()->id,
                    'type' => 'charge',
                    'amount' => $Order->paid_total,
                    'order_id' => $Order->id,
                    'service_id' => $Service->id
                ]
            );
            DB::commit();
            return redirect('/')->with('success_payment', 1);
        }
        return redirect('/')->with('failed_payment', 1);
    }




}
