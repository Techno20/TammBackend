<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
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
        $page = Page::where('page_key','about_us')->where('lang',app()->getLocale())->first();
        return view('site.pages.about_us')->with('page',$page);
    }
    public function getHowItWok(){
        $how_it_work_video = Setting::select('how_it_work_video')->first()->how_it_work_video;
        $pages = Page::where('page_key','how_it_work')->where('lang',app()->getLocale())->get();
        return view('site.pages.how_it_work')->with('pages',$pages)->with('how_it_work_video',$how_it_work_video);
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
