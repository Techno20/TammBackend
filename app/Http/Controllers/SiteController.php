<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function getLogout(){
        auth()->guard('web')->logout();
        return Redirect::back();
    }

    public function getAboutUs(){
        return view('site.pages.about_us');
    }
    public function getHowItWok(){
        return view('site.pages.how_it_work');
    }

    public function getSearch(Request $request){
        if (request()->s) {
            $Services = Service::onlyApproved()
                ->onlyActive()
                ->selectCard()
                ->where('title','LIKE','%'.request()->s.'%')
                ->orderBy('id','DESC')
                ->where('is_approved',1)
                ->paginate(20);
            return view('site.pages.search')->with('services',$Services);
        }
        return Redirect::back();
    }
}
