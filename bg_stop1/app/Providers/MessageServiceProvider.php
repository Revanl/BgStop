<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Auth;
use App\user;
use App\Chat;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    use AuthenticatesUsers;

    public function boot()
    {
        view()->composer('layout.app', function ($view){

            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $jobMessages = DB::table('job_messages')
                    ->join('jobs', 'job_messages.job_id', '=', 'jobs.id')
                    ->join('users', 'job_messages.user_id', '=', 'users.id')
                    ->where('jobs.user_id', '=', $user_id)
                    ->select('job_messages.*', 'jobs.name as jobName', 'users.name as jobUserName')
                    ->get();
                $jobMessagesSeen = DB::table('job_messages')
                    ->join('jobs', 'job_messages.job_id', '=', 'jobs.id')
                    ->join('users', 'job_messages.user_id', '=', 'users.id')
                    ->where('jobs.user_id', '=', $user_id)
                    ->where('job_messages.seen', '=', '0')
                    ->select('job_messages.*', 'jobs.name as jobName', 'users.name as jobUserName')
                    ->get();
                $view->jobMessages=$jobMessages;
                $view->jobMessagesSeen=$jobMessagesSeen;
            }else {
                $view->jobMessages = null;
                $view->jobMessagesSeen = null;
            }
        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $rentMessages = DB::table('rent_messages')
                    ->join('rents', 'rent_messages.rent_id', '=', 'rents.id')
                    ->join('users', 'rent_messages.user_id', '=', 'users.id')
                    ->where('rents.user_id', '=', $user_id)
                    ->select('rent_messages.*', 'rents.name as rentName', 'users.name as rentUserName')
                    ->get();
                $rentMessagesSeen = DB::table('rent_messages')
                    ->join('rents', 'rent_messages.rent_id', '=', 'rents.id')
                    ->join('users', 'rent_messages.user_id', '=', 'users.id')
                    ->where('rents.user_id', '=', $user_id)
                    ->where('rent_messages.seen', '=', '0')
                    ->select('rent_messages.*', 'rents.name as rentName', 'users.name as rentUserName')
                    ->get();
                $view->rentMessages=$rentMessages;
                $view->rentMessagesSeen=$rentMessagesSeen;
            }else {
                $view->rentMessages = null;
                $view->rentMessagesSeen = null;
            }
        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $purchaseMessages = DB::table('purchase_messages')
                    ->join('purchases', 'purchase_messages.purchase_id', '=', 'purchases.id')
                    ->join('users', 'purchase_messages.user_id', '=', 'users.id')
                    ->where('purchases.user_id', '=', $user_id)
                    ->select('purchase_messages.*', 'purchases.name as purchaseName', 'users.name as purchaseUserName')
                    ->get();
                $purchaseMessagesSeen = DB::table('purchase_messages')
                    ->join('purchases', 'purchase_messages.purchase_id', '=', 'purchases.id')
                    ->join('users', 'purchase_messages.user_id', '=', 'users.id')
                    ->where('purchases.user_id', '=', $user_id)
                    ->where('purchase_messages.seen', '=', '0')
                    ->select('purchase_messages.*', 'purchases.name as purchaseName', 'users.name as purchaseUserName')
                    ->get();
                $view->purchaseMessages=$purchaseMessages;
                $view->purchaseMessagesSeen=$purchaseMessagesSeen;
            }else {
                $view->purchaseMessages = null;
                $view->purchaseMessagesSeen = null;
            }
        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $datingProfileMessages = DB::table('dating_profile_messages')
                    ->join('dating_profiles', 'dating_profile_messages.dating_profile_id', '=', 'dating_profiles.id')
                    ->join('users', 'dating_profile_messages.user_id', '=', 'users.id')
                    ->where('dating_profiles.user_id', '=', $user_id)
                    ->select('dating_profile_messages.*', 'dating_profiles.name as datingProfileName', 'users.name as datingProfileUserName')
                    ->get();
                $datingProfileMessagesSeen = DB::table('dating_profile_messages')
                    ->join('dating_profiles', 'dating_profile_messages.dating_profile_id', '=', 'dating_profiles.id')
                    ->join('users', 'dating_profile_messages.user_id', '=', 'users.id')
                    ->where('dating_profiles.user_id', '=', $user_id)
                    ->where('dating_profile_messages.seen', '=', '0')
                    ->select('dating_profile_messages.*', 'dating_profiles.name as datingProfileName', 'users.name as datingProfileUserName')
                    ->get();
                $view->datingProfileMessages=$datingProfileMessages;
                $view->datingProfileMessagesSeen=$datingProfileMessagesSeen;

            }else {
                $view->datingProfileMessages = null;
                $view->datingProfileMessagesSeen=null;
            }

        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $lessonMessages = DB::table('lesson_messages')
                    ->join('lessons', 'lesson_messages.lesson_id', '=', 'lessons.id')
                    ->join('users', 'lesson_messages.user_id', '=', 'users.id')
                    ->where('lessons.user_id', '=', $user_id)
                    ->select('lesson_messages.*', 'lessons.name as lessonName', 'users.name as lessonUserName')
                    ->get();
                $lessonMessagesSeen = DB::table('lesson_messages')
                    ->join('lessons', 'lesson_messages.lesson_id', '=', 'lessons.id')
                    ->join('users', 'lesson_messages.user_id', '=', 'users.id')
                    ->where('lessons.user_id', '=', $user_id)
                    ->where('lesson_messages.seen', '=', '0')
                    ->select('lesson_messages.*', 'lessons.name as lessonName', 'users.name as lessonUserName')
                    ->get();
                $view->lessonMessages=$lessonMessages;
                $view->lessonMessagesSeen=$lessonMessagesSeen;
            }else {
                $view->lessonMessages = null;
                $view->lessonMessagesSeen = null;
            }
        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $user_id = auth()->user()->id;

                $serviceMessages = DB::table('service_messages')
                    ->join('services', 'service_messages.service_id', '=', 'services.id')
                    ->join('users', 'service_messages.user_id', '=', 'users.id')
                    ->where('services.user_id', '=', $user_id)
                    ->select('service_messages.*', 'services.name as serviceName', 'users.name as serviceUserName')
                    ->get();
                $serviceMessagesSeen = DB::table('service_messages')
                    ->join('services', 'service_messages.service_id', '=', 'services.id')
                    ->join('users', 'service_messages.user_id', '=', 'users.id')
                    ->where('services.user_id', '=', $user_id)
                    ->where('service_messages.seen', '=', '0')
                    ->select('service_messages.*', 'services.name as serviceName', 'users.name as serviceUserName')
                    ->get();
                $view->serviceMessages=$serviceMessages;
                $view->serviceMessagesSeen=$serviceMessagesSeen;
            }else {
                $view->serviceMessages = null;
                $view->serviceMessagesSeen = null;
            }
        });

        view()->composer('layout.app', function ($view) {
            if(Auth::user()) {
                $friends = User::where('id', '!=', Auth()->user()->id)
                ->orderBy('name', 'asc')
                    ->get();


//                $friends = DB::table('chat')
//                    ->leftJoin('users', function($join){
//                        $join->on('chat.sender','=','users.id');
//                        $join->orOn('chat.receiver','=','users.id');
//                    })
//                    ->distinct()
//->select('users.id as id', 'users.name as name','users.image as image', 'chat.seen as seen')
//                    ->get();

$friendMessages = DB::table('chat')
->join('users', 'users.id', '=', 'chat.sender')
->where('chat.receiver', '=', Auth()->user()->id)
->where('chat.seen', '=', 0)
->distinct()
->select('users.id as id', 'users.name as name','users.image as image', 'chat.seen as seen')
->get();

                $view->friends=$friends;
                $view->friendMessages=$friendMessages;
            }else {
                $view->friends = null;
                $view->friendMessages = null;
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
