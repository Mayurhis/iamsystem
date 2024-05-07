<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Backend\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('logout/{tokenInvalid?}', [LoginController::class, 'logout'])->name('logout')->middleware('isAccessTokenExpire');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get("admin/login", [LoginController::class, 'index'])->name("admin.login");
    Route::post('admin/login',[LoginController::class, 'login'])->name('admin.login');
    Route::get('admin/forgot-password',[LoginController::class, 'showForgotPassword'])->name('admin.showForgotPassword');
    Route::post('admin/forgot-password',[LoginController::class, 'submitForgotPassword'])->name('admin.submitForgotPassword');

});


Route::group(["namespace" => "App\Http\Controllers\Backend",'as' => 'admin.',"prefix" => "admin" ,'middleware' => ['IsUserLoggedIn','isAccessTokenExpire','jwt.verify']],function(){

    Route::get("dashboard","DashboardController@index")->name("dashboard");

    Route::get("profile","ProfileController@profile")->name("profile");
    Route::get('user-detail', 'ProfileController@userDetail')->name('user_detail');
    Route::post('update-profile',"ProfileController@updateProfile")->name('updateProfile');

    Route::post('update-password',"ProfileController@updatePassword")->name('updatePassword');

    Route::resource('users',UserController::class);

});
