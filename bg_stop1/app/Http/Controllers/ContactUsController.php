<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Auth;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact_us/index');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'telephone'=>'required',
            'email'=>'required',
        ]);

        $contact_us = new ContactUs;
        $contact_us->telephone = ucfirst(filter_var($request->input('telephone', FILTER_SANITIZE_STRING)));
        $contact_us->email = ucfirst(filter_var($request->input('email'),FILTER_SANITIZE_STRING));
        $contact_us->message = $request->input('message');
        if(!Auth::guest()) {
            $contact_us->user_id = auth()->user()->id;
        }else{
            $contact_us->user_id = null;
        }
        $contact_us->save();
        return redirect('/contactUs')->with('success', 'Скоро ще се свържем с вас');
    }
}
