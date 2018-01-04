<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseMessage;

class PurchasesController extends Controller
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
        $purchase = new PurchaseMessage;
        $purchase->message = $request->input('message');
        $purchase->user_id = auth()->user()->id;
        $purchase->purchase_id = $id;
        $purchase->seen = false;
        $purchase->save();
        return redirect('purchases')->with('success', 'Успешно изпратено съобщение');
    }
    public function index()
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->paginate(10);
        return view('purchases.index')->with('purchases', $purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchases.create');
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
            $path = $request->file('image')->storeAs('public/purchases/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $purchase = new Purchase;
        $purchase->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $purchase->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $purchase->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $purchase->description = $request->input('description');
        $purchase->image = $fileNameToStore;
        $purchase->user_id = auth()->user()->id;
        $purchase->save();
        return redirect('/purchases')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::find($id);
        return view('purchases.show')->with('purchase',$purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        // Check for correct user
        if(auth()->user()->id !== $purchase->user_id){
            return redirect('/purchases')->with('error', 'Нямате достъп към тази страница');
        }
        return view('purchases.edit')->with('purchase', $purchase);
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
            $path = $request->file('image')->storeAs('public/purchases/images', $fileNameToStore);
        }

        $purchase = Purchase::find($id);
        $purchase->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $purchase->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $purchase->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $purchase->description = $request->input('description');
        if($request->hasFile('image')){
            $purchase->image = $fileNameToStore;
        }
        $purchase->save();
        return redirect('/purchases')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        // Check for correct user
        if(auth()->user()->id !== $purchase->user_id){
            return redirect('/purchases')->with('error', 'Нямате достъп към тази страница');
        }
        if($purchase->image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/purchases/images/'.$purchase->image);
        }
        $purchase->delete();
        return redirect('/purchases')->with('success', 'Успешна изтрихте продукта');
    }
}
