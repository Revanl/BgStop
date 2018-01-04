<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
php     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::orderBy('created_at', 'desc')->paginate(10);
       return view('index')->with('posts', $posts);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'message'=>'required',
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
            $path = $request->file('image')->storeAs('public/posts/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

       // $job = new JobMessage;
        $post = new Post;
        $post->user_id = Auth()->user()->id;
        $post->message = ucfirst(filter_var($request->input('message'),FILTER_SANITIZE_STRING));
        $post->image = $fileNameToStore;
        $post->save();
        return redirect('/')->with('success', 'Успешна публикация');
    }
}