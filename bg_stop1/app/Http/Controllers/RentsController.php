<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Rent;
use App\RentMessage;

class RentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request, $id)
    {
        $this->validate($request,[
            'message'=>'required'
        ]);
        $rent = new RentMessage;
        $rent->message = $request->input('message');
        $rent->user_id = auth()->user()->id;
        $rent->rent_id = $id;
        $rent->seen = false;
        $rent->save();
        return redirect('rents')->with('success', 'Успешно изпратено съобщение');
    }
    public function index()
    {
        $rents = Rent::orderBy('created_at', 'desc')-> paginate(10);
        return view('rents.index')->with('rents', $rents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rents.create');
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
            'name'=>'required',
            'location'=>'required',
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
            $path = $request->file('image')->storeAs('public/rents/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $rent = new Rent;
        $rent->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $rent->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $rent->description = $request->input('description');
        $rent->image = $fileNameToStore;
        $rent->user_id = auth()->user()->id;
        $rent->save();
        return redirect('/rents')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = Rent::find($id);
        return view('rents.show')->with('rent', $rent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rent = Rent::find($id);
        // Check for correct user
        if(auth()->user()->id !== $rent->user_id){
            return redirect('/rents')->with('error', 'Нямате достъп към тази страница');
        }
        return view('rents.edit')->with('rent', $rent);
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
            'name'=>'required',
            'location'=>'required',
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
            $path = $request->file('image')->storeAs('public/rents/images', $fileNameToStore);
        }

        $rent = Rent::find($id);
        $rent->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $rent->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $rent->description = $request->input('description');
        if($request->hasFile('image')){
            $rent->image = $fileNameToStore;
        }
        $rent->save();
        return redirect('/rents')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rent = Rent::find($id);
        // Check for correct user
        if(auth()->user()->id !== $rent->user_id){
            return redirect('/rents')->with('error', 'Нямате достъп към тази страница');
        }
        if($rent->image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/images/'.$rent->image);
        }
        $rent->delete();
        return redirect('/rents')->with('success', 'Успешна изтрихте продукта');
    }
}
