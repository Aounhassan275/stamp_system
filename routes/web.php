<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

/******************ADMIN PANELS ROUTES****************/
Route::group(['prefix' => 'admin', 'as'=>'admin.','namespace' => 'Admin'], function () {
 
    /*******************LOGIN ROUTES*************/
    Route::view('login', 'admin.auth.index')->name('login');
    Route::post('login','AuthController@login');  
    Route::group(['middleware' => 'auth:admin'], function () { 
    /*******************Logout ROUTES*************/       
    Route::get('logout','AuthController@logout')->name('logout');
    /*******************Dashoard ROUTES*************/
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard.index');
    /******************ADMIN ROUTES****************/
      Route::resource('admin', 'AdminController');    
    /*******************Profile ROUTES*************/
    Route::view('profile', 'admin.profile.index')->name('profile.index'); 
    /******************DECRIPTION ROUTES****************/
    Route::resource('description', 'DescriptionController');
    /******************Vendor ROUTES****************/
    Route::resource('vendor', 'VendorController');
    /******************STAMP ROUTES****************/
    Route::resource('stamp', 'StampController');
    /******************CHATS ROUTES****************/
    Route::get('chat/make_inactive/{id}', 'ChatController@make_inactive')->name('chat.make_inactive');
    Route::get('chat/make_active/{id}', 'ChatController@make_active')->name('chat.make_active');
    Route::post('get_latest_chat', 'ChatController@get_latest_chat')->name('chat.get_latest_chat');
    Route::resource('chat', 'ChatController');
    Route::resource('chatmessage', 'ChatMessageController');
});
});
/******************USER PANELS ROUTES****************/
Route::group(['prefix' => 'user', 'as'=>'user.','namespace' => 'User'], function () {
 
    /*******************LOGIN ROUTES*************/
    Route::view('login', 'user.auth.login')->name('login');
    Route::post('login','AuthController@login');
    Route::group(['middleware' => 'auth:user'], function () { 
    /*******************Logout ROUTES*************/       
    Route::get('logout','AuthController@logout')->name('logout');
    /*******************Dashoard ROUTES*************/
    Route::view('dashboard', 'user.dashboard.index')->name('dashboard.index');
       /******************USER PROFILE  ROUTES****************/
       Route::resource('user', 'UserController');
    /******************Chat  ROUTES****************/
    Route::get('chat/admin', 'ChatController@chatWithAdmin')->name('chat.admin');
    Route::get('chat/user/{id}', 'ChatController@chatWithUser')->name('chat.user');
    Route::resource('chat', 'ChatController');
    Route::resource('chatmessage', 'ChatMessageController');
});


    
});

/******************FRONTEND ROUTES****************/
Route::view('/', 'front.home.index');
Route::get('chat/{id}', 'FrontendController@chat');
Route::post('chat_message/store', 'FrontendController@chatmessageStore')->name('chatmessage.store');
Route::post('get_latest_chat', 'FrontendController@get_latest_chat')->name('chatmessage.get_latest_chat');

/******************FUNCTIONALITY ROUTES****************/
Route::get('/cd', function() {
    Artisan::call('config:cache');
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed', [ '--class' => DatabaseSeeder::class]);
    Artisan::call('view:clear');
    return 'DONE';
});
Route::get('/migrate', function() {
    Artisan::call('migrate');
    return 'Migration done';
});
Route::get('/cache_clear', function() {
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return 'Cache Clear DOne';
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

