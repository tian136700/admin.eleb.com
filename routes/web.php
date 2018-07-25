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

Route::get('/', function () {
    return view('welcome');
});
//商家
//Route::resource('users', 'UsersController');
Auth::routes();
Route::resource('shopcategories', 'ShopCategoriesController');
Route::get('/shopsreview/{review}', 'ShopsController@review')->name("shops.review");
Route::post('/shopsreview/{review}', 'ShopsController@updateReview')->name("shops.updatereview");
Route::resource('shops', 'ShopsController');
Route::resource('shopusers', 'ShopUsersController');
Route::resource('admins', 'AdminsController');

Route::get('slogin', 'SessionsController@create')->name('slogin');
Route::post('slogin', 'SessionsController@store')->name('slogin');
Route::delete('sdelete', 'SessionsController@destroy')->name('slogout');
Route::get("shops/reset/{shop}","ShopsController@reset")->name("shops.reset");
Route::post("shops/updatereset/{shop}","ShopsController@updateReset")->name("shops.updatereset");


Route::get('/home', 'HomeController@index')->name('home');

//图片上传路由
Route::post("upload",function (){
    $storage=\Illuminate\Support\Facades\Storage::disk("oss");
    $filename=$storage->putFile("upload",request()->file("file"));
    return ["filename"=>$storage->url($filename)];
})->name("upload");

//未登录用户跳转
Route::group(['middleware' => 'check.login'], function() {
    Route::get('/slogin', 'SessionsController@create')->name('slogin');
});
