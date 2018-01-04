<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Lesson;
use App\LessonMessage;

class LessonsController extends Controller
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
        $lesson = new LessonMessage;
        $lesson->message = $request->input('message');
        $lesson->user_id = auth()->user()->id;
        $lesson->lesson_id = $id;
        $lesson->seen = false;
        $lesson->save();
        return redirect('lessons')->with('success', 'Успешно изпратено съобщение');
    }
    public function index()
    {
        $lessons = Lesson::orderBy('created_at', 'desc')->paginate(10);
        return view('lessons.index')->with('lessons', $lessons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lessons.create');
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
            $path = $request->file('image')->storeAs('public/lessons/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $lesson = new Lesson;
        $lesson->name = ucfirst(filter_var($request->input('name', FILTER_SANITIZE_STRING)));
        $lesson->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $lesson->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $lesson->description = $request->input('description');
        $lesson->image = $fileNameToStore;
        $lesson->user_id = auth()->user()->id;
        $lesson->save();
        return redirect('/lessons')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        return view('lessons.show')->with('lesson', $lesson);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        if(auth()->user()->id !== $lesson->user_id){
            return redirect('lessons')->with('error', 'Нямате достъп към тази страница');
        }
        return view('lessons.edit')->with('lesson', $lesson);
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
            $path = $request->file('image')->storeAs('public/lessons/images', $fileNameToStore);
        }

        $lesson = Lesson::find($id);
        $lesson->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $lesson->location = ucfirst(filter_var($request->input('location'),FILTER_SANITIZE_STRING));
        $lesson->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $lesson->description = $request->input('description');
        if($request->hasFile('image')){
            $lesson->image = $fileNameToStore;
        }
        $lesson->save();
        return redirect('/lessons')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        if(auth()->user()->id !== $lesson->user_id){
            return redirect('/lessons')->with('error', 'Нямате достъп към тази страница');
        }
        if($lesson->image != 'noimage.jpg'){

            Storage::delete('public/lessons/images/'.$lesson->image);
        }
        $lesson->delete();
        return redirect('/lessons')->with('success', 'Успешна изтрихте продукта');
    }
}
