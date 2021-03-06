<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\ContactusMessage;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.pages.ContactUs');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.pages.ContactUs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required'
        ]);

        $contactus = new ContactusMessage();
        $contactus->name = $request->name;
        $contactus->message = $request->message;
        $contactus->email = $request->email;
        $contactus->save();

        \Mail::to(Setting::first()->contact_email)->send(new \App\Mail\ContactUsMail(request()));
        return back()->with('success',trans('تم ارسال الرسالة بنجاح سوف نتواصل معك في اقرب وقت'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}
