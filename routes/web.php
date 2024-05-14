<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Backend\Auth\LoginController;
use  App\Http\Controllers\Backend\Auth\TwoFactorAuthController;


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

Route::group(['middleware' => ['check2fa.status']], function () {

    Route::get("admin/2fa/verify", [TwoFactorAuthController::class, 'index'])->name("admin.2fa");
    Route::post("admin/2fa/verify", [TwoFactorAuthController::class, 'verify'])->name("admin.2fa.verify");

    Route::post("admin/2fa/resend-code", [TwoFactorAuthController::class, 'resendVerificationCode'])->name("admin.2fa.resendcode");

});

    

Route::group(["namespace" => "App\Http\Controllers\Backend",'as' => 'admin.',"prefix" => "admin" ,'middleware' => ['IsUserLoggedIn','isAccessTokenExpire','jwt.verify','auth.2fa']],function(){

    Route::get("dashboard","DashboardController@index")->name("dashboard");

    Route::get("profile","ProfileController@profile")->name("profile");
    Route::post('update-profile',"ProfileController@updateProfile")->name('updateProfile');

    Route::post('update-password',"ProfileController@updatePassword")->name('updatePassword');

    Route::post('update-email',"ProfileController@updateEmail")->name('updateEmail');
    
    Route::post('update-useranme',"ProfileController@updateUsername")->name('updateUsername');

    Route::resource('users',UserController::class);
    
    Route::get("users/{id}/change-user-password","UserController@changeUserPassword")->name("users.changeUserPassword");
    
    Route::post('users/change-user-password/{id}',"UserController@submitChangeUserPassword")->name('users.submitChangeUserPassword');
    
    
    Route::get("users/{id}/create-access-token","UserController@showCreateAccessToken")->name("users.showCreateAccessToken");
    
    Route::post('users/create-access-token/{id}',"UserController@submitAccessToken")->name('users.submitAccessToken');
    

    Route::get("users/{id}/metadata-editor","UserController@showMetaDataEditor")->name("users.showMetaDataEditor");
    
    Route::post('users/metadata-editor/{id}',"UserController@submitMetaDataEditor")->name('users.submitMetaDataEditor');

});
