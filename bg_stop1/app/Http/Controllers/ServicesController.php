<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Service;
use App\ServiceMessage;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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
        $service = new ServiceMessage;
        $service->message = $request->input('message');
        $service->user_id = auth()->user()->id;
        $service->service_id = $id;
        $service->seen = false;
        $service->save();
        return redirect('services')->with('success', 'Успешно изпратено съобщение');
    }

    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
            'category'=>'required',
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
            $path = $request->file('image')->storeAs('public/services/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $service = new Service;
        $service->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $service->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $service->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $service->description = $request->input('description');
        $service->image = $fileNameToStore;
        $service->user_id = auth()->user()->id;
        $service->save();
        return redirect('/services')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        // Check for correct user
        if(auth()->user()->id !== $service->user_id){
            return redirect('/services')->with('error', 'Нямате достъп към тази страница');
        }
        return view('services.edit')->with('service', $service);
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
            'category'=>'required',
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
            $path = $request->file('image')->storeAs('public/services/images', $fileNameToStore);
        }

        $service = Service::find($id);
        $service->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $service->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $service->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $service->description = $request->input('description');
        if($request->hasFile('image')){
            $service->image = $fileNameToStore;
        }
        $service->save();
        return redirect('/services')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        // Check for correct user
        if(auth()->user()->id !== $service->user_id){
            return redirect('/purchases')->with('error', 'Нямате достъп към тази страница');
        }
        if($service->image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/services/images/'.$service->image);
        }
        $service->delete();
        return redirect('/services')->with('success', 'Успешна изтрихте услугата');
    }
}
