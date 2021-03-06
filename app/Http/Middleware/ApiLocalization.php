<?php

namespace App\Http\Middleware;

use Closure;

class ApiLocalization
{

  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    // Check header request and determine localizaton
//    $local = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : config('app.locale');
//      if(isset($_GET['testing']) && !empty($_GET['testing']) && $_GET['testing'] == 'true'){
//
//      }else{
//        echo '<center>جاري رفع نسخة جديدة , الرجاء الانتظار</center>';die();
//      }
    $local = config('app.locale');
    if(session()->get('locale')){
        $local = session()->get('locale');
    }
    if($request->hasHeader('X-localization')){
        $local = $request->header('X-localization');
    }
    // set laravel localization
    app()->setLocale($local);
    // continue request
    return $next($request);
  }
}
