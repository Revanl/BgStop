<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\forumCategory;
use App\forumTopic;
use App\ForumTopicReply;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index', 'show', 'showPost']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forum_categories = ForumCategory::orderBy('created_at', 'desc')-> paginate(10);
        return view('forum.index')->with('forum_categories', $forum_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
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
                'category'=>'required',
            ]);

            $forum_category = new ForumCategory();
            $forum_category->user_id = auth()->user()->id;
            $forum_category->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
            $forum_category->save();
            return redirect('/forum')->with('success', 'Успешна публикация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum_category = ForumCategory::find($id);
        $forum_topics = ForumTopic::orderBy('created_at', 'desc')->where('category_id' ,'=', $forum_category->id)-> paginate(10);
        return view('forum.show')->with('forum_category', $forum_category)->with('forum_topics', $forum_topics);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum_category = ForumCategory::find($id);
        // Check for correct user
        if(auth()->user()->id !== $forum_category->user_id){
            return redirect('/forum')->with('error', 'Нямате достъп към тази страница');
        }
        return view('forum.edit')->with('forum_category', $forum_category);
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
            'category'=>'required',
        ]);
        $forum_category = ForumCategory::find($id);
        $forum_category->category = ucfirst(filter_var($request->input('category'),FILTER_SANITIZE_STRING));
        $forum_category->save();
        return redirect('/forum')->with('success', 'Успешна редакция на категорията');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum_category = ForumCategory::find($id);
        // Check for correct user
        if(auth()->user()->id !== 1){
            return redirect('/rents')->with('error', 'Нямате достъп към тази страница');
        }
        $forum_category->delete();
        return redirect('/forum')->with('success', 'Успешна изтрихте категорията');
    }

    public function createPost($id)
    {
        $forum_category = ForumCategory::find($id);
        return view('forum.topics.create')->with('forum_category', $forum_category);
    }

    public function storePost(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ]);
        $forum_topic = new ForumTopic;
        $forum_topic->name = ucfirst(filter_var($request->input('name'),FILTER_SANITIZE_STRING));
        $forum_topic->description = $request->input('description');
        $forum_topic->category_id = $id;
        $forum_topic->user_id = auth()->user()->id;
        $forum_topic->save();
        return redirect('/forum/'.$id)->with('success', 'Успешна публикация');
    }

    public function showPost(Request $request, $id, $topic_id)
    {
        $forum_category = ForumCategory::find($id);
        $forum_topic = ForumTopic::find($topic_id);
        $forum_topic_replies = DB::table('forum_topic_replies')
            ->join('users', 'forum_topic_replies.user_id', '=', 'users.id')
            ->where('forum_topic_replies.topic_id', '=', $topic_id)
            ->select('forum_topic_replies.*', 'users.name as ForumReplyUserName', 'users.gender as ForumReplyUserGender', 'users.image as ForumReplyUserImage')
            ->paginate(10);

        return view('forum.topics.show')
            ->with('forum_category', $forum_category)
            ->with('forum_topic', $forum_topic)
            ->with('forum_topic_replies', $forum_topic_replies);
    }

    public function reply(Request $request, $id, $topic_id)
    {

        $this->validate($request,[
            'message'=>'required',
        ]);

        $forum_topic_reply = new ForumTopicReply();
        $forum_topic_reply->message = $request->input('message');
        $forum_topic_reply->topic_id = $topic_id;
        $forum_topic_reply->user_id = auth()->user()->id;
        $forum_topic_reply->save();
        return redirect('/forum/'.$id.'/topics/'.$topic_id)->with('success', 'Успешна публикация');
    }
}
