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

//Route::get('/', function () {
//    return view('shops/index');
//});
//商家
//Route::resource('users', 'UsersController');
Auth::routes();
Route::resource('shopcategories', 'ShopCategoriesController');
Route::get('/shopsreview/{review}', 'ShopsController@review')->name("shops.review");
Route::post('/shopsreview/{review}', 'ShopsController@updateReview')->name("shops.updatereview");

Route::resource('shops', 'ShopsController')/*->middleware('auth')*/;
Route::resource('shopusers', 'ShopUsersController');
//管理员管理
Route::resource('admins', 'AdminsController');


Route::get("shops/reset/{shop}", "ShopsController@reset")->name("shops.reset");
Route::post("shops/updatereset/{shop}", "ShopsController@updateReset")->name("shops.updatereset");


Route::get('/home', 'HomeController@index')->name('home');

//图片上传路由
Route::post("upload", function () {
    $storage = \Illuminate\Support\Facades\Storage::disk("oss");
    $filename = $storage->putFile("upload", request()->file("file"));
    return ["filename" => $storage->url($filename)];
})->name("upload");

//未登录用户跳转
//Route::group(['middleware' => 'check.login'], function () {
//    Route::get('/login', 'SessionsController@create')->name('login');
//});

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::get('delete', 'SessionsController@destroy')->name('logout');
//禁用会员功能
Route::get('/members/disable/{member}', 'MemberController@disable')->name('members.disable');
//会员管理
Route::resource('members', 'MemberController');

//统计
Route::get('/count/index', 'CountController@index')->name('count.index');
Route::get('/count/menus', 'CountController@menus')->name('countmenus.index');
//权限管理
Route::resource('permissions', 'PermissionController');
//角色管理
Route::resource('roles', 'RoleController');
//菜单管理
Route::resource('navs', 'NavController');

//抽奖结果
Route::get('/events/{event}/eventresult', 'EventController@eventResult')->name("events.eventresult");
//抽奖活动
Route::resource('events', 'EventController');
//进入奖品列表

//抽奖活动奖品
Route::resource('eventprizes', 'EventPrizeController');
//发送邮件测试
Route::get("email", "EventController@sendEmail");
//活动管理
Route::resource('activities', 'ActivityController');
//一键生成或更新活动静态页
Route::get("/activityStatic", "ActivityController@activityStatic")->name("activityStatic");



