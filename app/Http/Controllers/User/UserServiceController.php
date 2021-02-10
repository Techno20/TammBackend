<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UploaderController;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\ServiceGallery;
use App\Models\ServiceExtra;
use App\Models\OrderExtra;
use App\Models\User;
use Helper, Storage;
use Illuminate\Support\Facades\Redirect;

class UserServiceController extends Controller
{

    /**
     * Get services list
     * 
     * @param Request $q
     */
    public function getList(Request $q)
    {
        $Services = Service::selectCard()->where('user_id',auth()->user()->id);

        /* Filters */

        // By main category type
        if (request()->main_category_type && request()->main_category_type != 'all') {
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

        $Services = $Services->paginate(50);
//        return Helper::responseData('success',true,$Services);
        return view('site.user.dashboard.services')->with('services',$Services);
    }

    /**
     * Get service
     * 
     * @param integer $serviceId
     * @param Request $q
     */
    public function getShow($serviceId,Request $q)
    {
        $Service = Service::where('id',$serviceId)->with('Extras')->authorized()->first();
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
            'main_category_type' => ['required',new \App\Rules\MainCategoryTypeRule],
            'category_id' => ['required',new \App\Rules\CategoryRule($q->main_category_type)],
            'title' => 'required|max:255',
            'is_active' => 'boolean',
            'basic_price' => 'numeric',
            'standard_price' => 'numeric',
            'premium_price' => 'numeric',
            'basic_services_list' => 'array',
            'standard_services_list' => 'array',
            'premium_services_list' => 'array',
//            'extras' => 'array',
            'extras_title' => 'array',
            'extras_price' => 'array',
            'gallery' => 'array'
        ]);
        if($validator->fails()) {
        return Helper::responseValidationError($validator->messages());
        }

        if($serviceId){
            $Service = Service::where('id',$serviceId)->authorized()->with('Extras')->first();
        }else {
            $Service = new Service;
            $Service->user_id = auth()->user()->id;
        }
        $Service->title = $q->title;
        $Service->main_category_type = $q->main_category_type;
        $Service->category_id = $q->category_id;
        $Service->description = $q->description;

        $Service->basic_price = $q->basic_price;
        $Service->basic_title = $q->basic_title;
        $Service->basic_description = $q->basic_description;
        $Service->basic_services_list = $q->basic_services_list;
        $Service->basic_delivery_days = $q->basic_delivery_days;

        $Service->standard_price = $q->standard_price;
        $Service->standard_title = $q->standard_title;
        $Service->standard_description = $q->standard_description;
        $Service->standard_services_list = $q->standard_services_list;
        $Service->standard_delivery_days = $q->standard_delivery_days;

        $Service->premium_price = $q->premium_price;
        $Service->premium_title = $q->premium_title;
        $Service->premium_description = $q->premium_description;
        $Service->premium_services_list = $q->premium_services_list;
        $Service->premium_delivery_days = $q->premium_delivery_days;
        $Service->save();

        // Save gallery images and videos
        if(is_array($q->gallery) && count($q->gallery)){
            if($serviceId){
                // Delete previous records
                ServiceGallery::where('service_id',$Service->id)->delete();
            }

            $galleryItems = [];
            foreach($q->gallery as $galleryItem){
                $upload = new UploaderController();
//                $galleryItemResponse = $upload->postUpload('service-image',$q);
                $upload->folder = 'services/gallery';
                $upload->thumbFolder = 'services/thumbs';
                $galleryItemResponse = $upload->uploadSingle($galleryItem,true,1000,0,320);
//                $galleryItemResponse = $upload->postUpload('service-image',$q);
                if(isset($galleryItemResponse['path']) && Storage::exists('services/gallery/'.$galleryItemResponse['path'])){
                    $galleryItems[] = [
                        'service_id' => $Service->id,
                        'path' => $galleryItemResponse['path']
                    ];
                }
            }

            if(count($galleryItems)){
                ServiceGallery::insert($galleryItems);
            }
        }

        // Check deleted extra services
        if($serviceId){
            $oldServiceExtras = $Service->Extras;
            if($oldServiceExtras->count()){
                $newServiceExtras = collect($q->extras);
                foreach($oldServiceExtras as $oldServiceExtra){
                    if(!$newServiceExtras->where('id',$oldServiceExtra->id)->count()){
                        // check if it has orders
                        $checkOrderExtra = OrderExtra::where('services_extra_id',$oldServiceExtra->id)->count();
                        if($checkOrderExtra){
                            $oldServiceExtra->delete();
                        }else {
                            $oldServiceExtra->forceDelete();
                        }
                    }
                }
            }
        }
        // Add or Update service extras
//        dd($q->extras);
        if(is_array($q->extras_title) && count($q->extras_title) && is_array($q->extras_price) && count($q->extras_price)){
            $insertExtraServices = [];
            $prices = $q->extras_price;
            foreach($q->extras_title as $key => $value){
                if(isset($value) && !empty($value)){
                    $servicePrice = (isset($prices[$key]) && is_numeric($prices[$key])) ? $prices[$key] : 0;
                    $saveExtraDetails = [
                        'service_id' => $Service->id,
                        'title' => $value,
                        'price' => $servicePrice
                    ];
//                    if(isset($extraService['id'])){
//                        $updateServiceExtra = ServiceExtra::where('id',$extraService['id'])->where('service_id',$Service->id)->update($saveExtraDetails);
//                    }else {
                        $insertExtraServices[] = $saveExtraDetails;
//                    }
                }
            }
            $ServiceExtra = ServiceExtra::insert($insertExtraServices);
        }
        $Service = Service::where('id',$serviceId)->with('Extras')->authorized()->first();

//        return Helper::responseData('service_saved',true,$Service,__('default.success_message.service_saved'));
        return Redirect::to('user/service/list');
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
            // Delete related records
            ServiceGallery::where('service_id',$serviceId)->delete();
            ServiceReview::where('service_id',$serviceId)->delete();
            ServiceExtra::where('service_id',$serviceId)->delete();
            return Helper::responseData('service_deleted',true,false,__('default.success_message.service_deleted'));
        }else {
            return Helper::responseData('service_not_found',false,false,__('default.error_message.service_not_found'),404);
        }
    }

    /**
     * Activation
     * 
     * @param integer $serviceId
     * @param Request $q
     */
    public function postActivation($serviceId,Request $q)
    {
        $validator = validator()->make($q->all(), [
            'is_active' => 'boolean|required'
        ]);
        if($validator->fails()) {
        return Helper::responseValidationError($validator->messages());
        }

        $Service = Service::where('id',$serviceId)->authorized()->first();
        if($Service) {
            $Service->is_active = ($q->is_active === false) ? 0 : 1;
            $Service->save();
            return Helper::responseData('success',true);
        }else {
            return Helper::responseData('success',false);
        }
    }

    /**
     * new Code By Mohammed Ali Fnannah
     * add new services page
     */

    public function getForm(Request $request){
        return view('site.user.service.create');
    }
    public function getPricing(Request $request){
        return view('site.user.service.pricing');
    }
}
