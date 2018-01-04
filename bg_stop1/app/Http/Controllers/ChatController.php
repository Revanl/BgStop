<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Chat;
use App\User;

class ChatController extends Controller
{

    public function findContactUrl(Request $request)
    {
      //  $selectedFriend = $request->input('selectedFriend');
        $selectedFriend = User::find($request->input('selectedFriend'));
        $selectedFriend = json_encode($selectedFriend);
        echo $selectedFriend;
    }

    public function destroySession(Request $request)
    {
        $request->session()->forget('selectedFriend');

        $request->session()->flush();
    }
    public function setSession(Request $request)
    {
        $selectedFriend = $request->input('selectedFriend');
        $friendName = User::where('id','=',$selectedFriend)->get();
        $request->session()->put('selectedFriend', $selectedFriend);
        $request->session()->put('friendName', $selectedFriend);

//        $getChat = Chat::with('users')
//            ->where([
//                ['receiver', array($selectedFriend)],
//                ['sender',  array(Auth()->user()->id)],
//            ])
//            ->orWhere([
//                ['receiver', array(Auth()->user()->id)],
//                ['sender',  array($selectedFriend)],
//            ])
//            ->get();

        $getChat = DB::table('chat')
            ->join('users', 'users.id', '=', 'chat.receiver')
            ->where([
                ['chat.receiver', array($selectedFriend)],
                ['chat.sender',  array(Auth()->user()->id)],
            ])
            ->orWhere([
                ['chat.receiver', array(Auth()->user()->id)],
                ['chat.sender',  array($selectedFriend)],
            ])
            ->get();


        $markSeen = Chat::where('sender', '=', $selectedFriend)
            ->update(['seen' => true]);



//        $serviceMessage = ServiceMessage::find($selectedFriend);
//        $serviceMessage->seen = true;
//        $serviceMessage->save();
//        $service = Service::where('user_id', '=', $serviceMessage->service_id)->first();

        $jsonChat = json_encode($getChat);
        echo $jsonChat;
    }
    public function send(Request $request)
    {
        $chat = new Chat;
        $chat->message = ucfirst(filter_var($request->input('message'), FILTER_SANITIZE_STRING));
        $chat->sender = auth()->user()->id;
        $chat->receiver = $request->session()->get('selectedFriend');
        $chat->seen = false;
        $chat->save();
        echo $request->input('message');
    }

    public function refresh(Request $request)
    {
        $selectedFriend = $request->session()->get('selectedFriend');
        $getChat = Chat::where([
            ['receiver', array($selectedFriend)],
            ['sender',  array(Auth()->user()->id)],
        ])
            ->orWhere([
                ['receiver', array(Auth()->user()->id)],
                ['sender',  array($selectedFriend)],
            ])
            ->get();

//        $getChat = DB::table('chat')
//            ->join('users', 'users.id', '=', 'chat.receiver')
//            ->leftjoin('users', function($join){
//                $join->on('users.id', '=', 'chat.receiver');
//                $join->orOn('users.id', '=', 'chat.sender');
//            })
//            ->where([
//                ['chat.receiver', array($selectedFriend)],
//                ['chat.sender',  array(Auth()->user()->id)],
//            ])
//            ->orWhere([
//                ['chat.receiver', array(Auth()->user()->id)],
//                ['chat.sender',  array($selectedFriend)],
//            ])
//            ->get();

//
//        $markSeen = Chat::where('sender', '=', $selectedFriend)
//            ->update(['seen' => true]);

        //JOIN AND UNION
        $jsonChat = json_encode($getChat);
        echo $jsonChat;
    }
}
