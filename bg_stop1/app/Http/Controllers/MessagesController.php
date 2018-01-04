<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Job;
use App\JobMessage;
use App\Rent;
use App\RentMessage;
use App\Purchase;
use App\PurchaseMessage;
use App\Lesson;
use App\LessonMessage;
use App\Dating;
use App\DatingMessage;
use App\Service;
use App\ServiceMessage;
use App\ForumTopic;
use App\ForumTopicReply;
use App\ForumCategory;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function job($id)
    {
        $jobMessage = JobMessage::find($id);
        $jobMessage->seen = true;
        $jobMessage->save();
        $job = Job::where('id', '=', $jobMessage->job_id)->first();
        return view('messages.jobMessagesShow')->with('jobMessage', $jobMessage)->with('job', $job);
    }
    public function rent($id)
    {
        $rentMessage = RentMessage::find($id);
        $rentMessage->seen = true;
        $rentMessage->save();
        $rent = Rent::where('id', '=', $rentMessage->rent_id)->first();
        return view('messages.rentMessagesShow')->with('rentMessage', $rentMessage)->with('rent', $rent);
    }
    public function purchase($id)
    {
        $purchaseMessage = PurchaseMessage::find($id);
        $purchaseMessage->seen = true;
        $purchaseMessage->save();
        $purchase = Purchase::where('id', '=', $purchaseMessage->purchase_id)->first();
        return view('messages.purchaseMessagesShow')->with('purchaseMessage', $purchaseMessage)->with('purchase', $purchase);
    }
    public function lesson($id)
    {
        $lessonMessage = LessonMessage::find($id);
        $lessonMessage->seen = true;
        $lessonMessage->save();
        $lesson = Lesson::where('id', '=', $lessonMessage->lesson_id)->first();
        return view('messages.lessonMessagesShow')->with('lessonMessage', $lessonMessage)->with('lesson', $lesson);
    }
    public function dating($id)
    {
        $datingMessage = DatingMessage::find($id);
        $datingMessage->seen = true;
        $datingMessage->save();
        $dating = Dating::where('user_id', '=', $datingMessage->user_id)->first();
        $userImage = User::where('id', '=', $dating->user_id)->first();
        return view('messages.datingMessagesShow')->with('datingMessage', $datingMessage)->with('dating', $dating)->with('userImage', $userImage);
    }
    public function service($id)
    {
        $serviceMessage = ServiceMessage::find($id);
        $serviceMessage->seen = true;
        $serviceMessage->save();
        $service = Service::where('user_id', '=', $serviceMessage->service_id)->first();
        return view('messages.serviceMessagesShow')->with('serviceMessage', $serviceMessage)->with('service', $service);
    }
//    public function forum($id)
//    {
//        $forumMessage = ForumTopicReply::find($id);
//        $forumMessage->seen = true;
//        $forumMessage->save();
//        $forumTopic = ForumTopic::where('id', '=', $forumMessage->topic_id)->first();
//        $forumCategory = ForumCategory::where('id', '=', $forumMessage->category_id)->first();
//        return view('messages.forumMessagesShow')->with('forumMessage', $forumMessage)->with('forumTopic', $forumTopic)->with('forumCategory', $forumCategory);
//    }
}
