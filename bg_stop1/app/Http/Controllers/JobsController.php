<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Job;
use App\JobMessage;

class JobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * For job applications
     */
    public function message(Request $request, $id)
    {
        $this->validate($request,[
           'cv'=>'required|max:1999'
        ]);
            // see to it that only docx and pdf can be sent
        //Handle file upload
        if($request->hasFile('cv')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cv')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cv')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cv')->storeAs('public/jobs/cv/', $fileNameToStore);
        }else{
            return redirect('jobs{id}')->with('error', 'Трябва да качите cv');
        }

        $job = new JobMessage;
        $job->message = $request->input('message');
        $job->cv = $fileNameToStore;
        $job->user_id = auth()->user()->id;
        $job->job_id = $id;
        $job->seen = false;
        $job->save();
        return redirect('jobs')->with('success', 'Успешна кандидатура');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')-> paginate(10);
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
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
            'category'=>'required ',
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
            $path = $request->file('image')->storeAs('public/jobs/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $job = new Job;
        $job->name = ucfirst(filter_var($request->input('name'), FILTER_SANITIZE_STRING));
        $job->location = ucfirst(filter_var($request->input('location'), FILTER_SANITIZE_STRING));
        $job->category = ucfirst(filter_var($request->input('category'), FILTER_SANITIZE_STRING));
        $job->description = $request->input('description');
        $job->image = $fileNameToStore;
        $job->user_id = auth()->user()->id;
        $job->save();
        return redirect('/jobs')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        // Check for correct user
        if(auth()->user()->id !== $job->user_id){
            return redirect('/jobs')->with('error', 'Нямате достъп към тази страница');
        }
        return view('jobs.edit')->with('job', $job);
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
            $path = $request->file('image')->storeAs('public/jobs/images', $fileNameToStore);
        }

        $job = Job::find($id);
        $job->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $job->location = ucfirst(filter_var($request->input('location'), FILTER_SANITIZE_STRING));
        $job->category = ucfirst(filter_var($request->input('category'), FILTER_SANITIZE_STRING));
        $job->description = $request->input('description');
        if($request->hasFile('image')){
            $job->image = $fileNameToStore;
        }
        $job->save();
        return redirect('/jobs')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        // Check for correct user
        if(auth()->user()->id !== $job->user_id){
            return redirect('/jobs')->with('error', 'Нямате достъп към тази страница');
        }
        if($job->image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/jobs/images/'.$job->image);
        }
        $job->delete();
        return redirect('/jobs')->with('success', 'Успешна изтрихте продукта');
    }
}
