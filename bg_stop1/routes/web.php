<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/{id}', 'PostsController@comment');
Route::resource('/', 'PostsController');
//Route::get('posts', 'PostsController@home');


//Route::get('/', 'HomeController@index');
//Route::post('/', 'HomeController@store');

Route::get('messages/{id}', 'HomeController@show');


Route::get('jobMessages/{id}', 'MessagesController@job');
Route::get('rentMessages/{id}', 'MessagesController@rent');
Route::get('purchaseMessages/{id}', 'MessagesController@purchase');
Route::get('datingMessages/{id}', 'MessagesController@dating');
Route::get('lessonMessages/{id}', 'MessagesController@lesson');
Route::get('serviceMessages/{id}', 'MessagesController@service');
Route::get('forumMessages/{id}', 'MessagesController@forum');

Route::get('contactUs', 'ContactUsController@index');
Route::post('contactUs', 'ContactUsController@store');
//MAKE A ROUTE FOR JOB APPLICATIONS AND ALL OTHER APPLICATIONS

Route::post('jobs/{id}', 'JobsController@message');
Route::resource('jobs', 'JobsController');

Route::post('services/{id}', 'ServicesController@message');
Route::resource('services', 'ServicesController');

Route::post('rents/{id}', 'RentsController@message');
Route::resource('rents', 'RentsController');

Route::post('purchases/{id}', 'PurchasesController@message');
Route::resource('purchases', 'PurchasesController');

Route::post('dating/{id}', 'DatingController@message');
Route::resource('dating', 'DatingController');

Route::post('lessons/{id}', 'LessonsController@message');
Route::resource('lessons', 'LessonsController');

Route::resource('forum', 'ForumController');
Route::get('forum/{id}/topics/create', 'ForumController@createPost');
Route::post('forum/{id}/topics/store', 'ForumController@storePost');
Route::get('forum/{id}/topics/{topic_id}', 'ForumController@showPost');
Route::post('forum/{id}/topics/{topic_id}/reply', 'ForumController@reply');


Route::get('logout', 'Auth\LogoutController@index');

Route::post('edit', 'EditController@edit');
Route::get('edit', 'EditController@index');



Route::post('send', 'ChatController@send');
Route::post('setFriendChatSession', 'ChatController@setSession');
Route::get('refresh', 'ChatController@refresh');
Route::get('findContactUrl', 'ChatController@findContactUrl');

Auth::routes();

