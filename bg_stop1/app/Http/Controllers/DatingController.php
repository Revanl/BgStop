<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dating;
use App\DatingMessage;
use Auth;


class DatingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * For dating profile applications
     */
    public function message(Request $request, $id)
    {
        $this->validate($request,[
            'message'=>'required'
        ]);
        $datingProfile = new DatingMessage;
        $datingProfile->message = $request->input('message');
        $datingProfile->user_id = auth()->user()->id;
        $datingProfile->dating_profile_id = $id;
        $datingProfile->seen = false;
        $datingProfile->save();
        return redirect('dating')->with('success', 'Успешна кандидатура');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()){
            $user_id = 0;
        }else{
            $user_id = auth()->user()->id;
        }
        $datingProfiles = Dating::orderBy('created_at', 'desc')->paginate(10);
        $hasDatingProfile = Dating::where('user_id', '=', $user_id)->pluck('id')->toArray();
        return view('dating.index')->with('datingProfiles', $datingProfiles)->with('hasDatingProfile', $hasDatingProfile);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datingProfile = Dating::where('user_id', '=', auth()->user()->id)->get();
        if ($datingProfile->isEmpty()){
            return view('dating.create');
        } else {
           // return view('dating')->with('error', 'Вече имате профил');
            return redirect('dating')->with('error', 'Вече имате профил');;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image.*'=>'nullable|max:1999',
            'age'=>'required|numeric',
            'interested_in'=>'required',

        ]);

        //Handle file upload
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
            $path = $request->file('image')->storeAs('public/dating/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $datingProfile = new Dating;
        $datingProfile->image = $fileNameToStore;
        $datingProfile->name = ucfirst(filter_var(auth()->user()->name,FILTER_SANITIZE_STRING));
        $datingProfile->age = ucfirst(filter_var($request->input('age'),FILTER_SANITIZE_STRING));
        $datingProfile->gender = ucfirst(filter_var(auth()->user()->gender,FILTER_SANITIZE_STRING));
        $datingProfile->interested_in = ucfirst(filter_var($request->input('interested_in'),FILTER_SANITIZE_STRING));
        $datingProfile->likes = ucfirst(filter_var($request->input('likes'),FILTER_SANITIZE_STRING));
        $datingProfile->dislikes = ucfirst(filter_var($request->input('dislikes'),FILTER_SANITIZE_STRING));
        $datingProfile->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $datingProfile->description = $request->input('description');
        $datingProfile->user_id = auth()->user()->id;
        $datingProfile->save();
        return redirect('/dating')->with('success', 'Успешна публикация');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datingProfile = Dating::find($id);
        if(Auth::user()) {
            $hasDatingProfile = Dating::where('user_id', '=', Auth()->user()->id)->get();
        }else{
            $hasDatingProfile = null;
        }
        return view('dating.show')->with('datingProfile', $datingProfile)->with('hasDatingProfile', $hasDatingProfile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datingProfile = Dating::find($id);
        // Check for correct user
        if(auth()->user()->id !== $datingProfile->user_id){
            return redirect('/dating')->with('error', 'Нямате достъп към тази страница');
        }
        return view('dating.edit')->with('datingProfile', $datingProfile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'age'=>'required|numeric',
            'interested_in'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        //Handle file upload
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
            $path = $request->file('image')->storeAs('public/dating/images', $fileNameToStore);
        }

        $datingProfile = Dating::find($id);
        $datingProfile->age = ucfirst(filter_var($request->input('age'),FILTER_SANITIZE_STRING));
        $datingProfile->interested_in = ucfirst(filter_var($request->input('interested_in'),FILTER_SANITIZE_STRING));
        $datingProfile->likes = ucfirst(filter_var($request->input('likes'),FILTER_SANITIZE_STRING));
        $datingProfile->dislikes = ucfirst(filter_var($request->input('dislikes'),FILTER_SANITIZE_STRING));
        $datingProfile->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $datingProfile->description = $request->input('description');
        if($request->hasFile('image')){
            $datingProfile->image = $fileNameToStore;
        }
        $datingProfile->save();
        return redirect('/dating')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datingProfile = Dating::find($id);
        // Check for correct user
        if(auth()->user()->id !== $datingProfile->user_id){
            return redirect('/dating')->with('error', 'Нямате достъп към тази страница');
        }
        if($datingProfile->image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/dating/images/'.$datingProfile->image);
        }
        $datingProfile->delete();
        return redirect('/dating')->with('success', 'Успешна изтрихте продукта');
    }
}
