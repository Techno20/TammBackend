<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceGallery;
use Illuminate\Http\Request;
use App\Models\ContactusMessage;
use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Bank;
use App\Models\Country;
use App\Models\Skill;
use Helper;

class HelperController extends Controller
{

    /**
     * Get default parameters
     *
     * @param Request $q
     */
    public function getDefault(Request $q)
    {
        $Settings = Setting::first();
        $Categories = Category::selectCard()->withCount('Services')->get();
        $Result = [
            'categories' => $Categories,
            'commission_rate' => $Settings->commission_rate
        ];
        return Helper::responseData('success',true,$Result);
    }

    /**
     * Get all lists that we will use it in different ways like in website filters
     *
     * @param Request $q
     */
    public function getLists(Request $q)
    {
        $Banks = Bank::select('id','name_'.app()->getLocale().' as name')->get();
        $Countries = Country::select('id','name_'.app()->getLocale().' as name')->get();
        $Skills = Skill::select('id','name_'.app()->getLocale().' as name')->get();
        $Result = [
            'banks' => $Banks,
            'countries' => $Countries,
            'skills' => $Skills
        ];
        return Helper::responseData('success',true,$Result);
    }

    /**
     * Contact us
     */
    public function postContactUs(Request $q){
        $validator = validator()->make(request()->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required'
        ]);
        if($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }

        // Save message
        $ContactusMessage = new ContactusMessage;
        $ContactusMessage->name = $q->name;
        $ContactusMessage->email = $q->email;
        $ContactusMessage->message = $q->message;
        $ContactusMessage->save();

        \Mail::to(Setting::first()->contact_email)->send(new \App\Mail\ContactUsMail(request()));
        return Helper::responseData('email_sent',true,false,__('default.success_message.email_sent'));
    }

    public function delete_image(Request $request) {
        ServiceGallery::query()->where('id', $request['key'])->delete();
        return response()->json([
            'success' => true
        ]);
    }

}

