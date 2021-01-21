<?php

namespace App\Http\Controllers;

use Helper;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function changeLanguage($lang = 'en',Request $request){
        if (isset($lang) && !empty($lang) && in_array($lang,['ar','en'])){
            session()->put('locale',$lang);
            app()->setLocale($lang);
//            dd(config('app.locale'));
            return redirect()->back();
        }
    }
}
