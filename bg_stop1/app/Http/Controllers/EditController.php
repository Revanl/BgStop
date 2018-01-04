<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('auth.edit');
    }
    public function edit(Request $request)
    {
 //     Handle file upload
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/jobs/images', $fileNameToStore);
        }else {
            if ($request->input('gender') == 'мъж') {
                $fileNameToStore = 'img_avatar_m.png';
            } else {
                $fileNameToStore = 'img_avatar_w.png';
            }
        }
        $edit_user = User::find(Auth()->user()->id);
        $edit_user->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $edit_user->gender = filter_var($request->input('gender'),FILTER_SANITIZE_STRING);
        if($request->hasFile('image')){
            $edit_user->image = $fileNameToStore;
        }
        $edit_user->save();

        return redirect('/')->with('success', 'Успешна редакция');
    }
}
