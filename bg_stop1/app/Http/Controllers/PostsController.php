<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Post;
use App\PostComment;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = Post::with('PostComment', 'user')->orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }
    public function comment(Request $request, $id)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);
        $comments = new PostComment;
        $comments->comment = $request->input('message');
        if(Auth::user()) {
            $comments->user_id = auth()->user()->id;
        }else{
            $comments->user_id = null;
        }
        $comments->post_id = $id;
        $comments->save();
        return redirect('/')->with('success', 'Успешна публикация');
    }
    public function editComment(Request $request, $id)
    {

    }
    public function deleteComment($id)
    {

    }
    public function home()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);
        $post = new Post;
        
        if(Auth::user()) {
        $post->user_id = auth()->user()->id;
        }else{
            $post->user_id = null;
        }
        $post->message = $request->input('message');
        $post->save();
        return redirect('/')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/')->with('error', 'Нямате достъп към тази страница');
        }
        return view('posts/edit')->with('post', $post);
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
            'message'=>'required',
        ]);

        $post = Post::find($id);
        $post->message = $request->input('message');
        $post->save();
        return redirect('/')->with('success', 'Успешна редакция');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Нямате достъп към тази страница');
        }
        $post->delete();
        return redirect('/')->with('success', 'Успешна изтрихте публикация');
    }
}
