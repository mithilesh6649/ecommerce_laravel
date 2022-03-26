<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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

Auth::routes();

Route::get('/home ', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','as' => 'admin.','namespace' => 'App\Http\Controllers\Admin'],function(){
     //All the admin routes will be decleared here...........
    Route::match(['get', 'post'],'/',[AdminController::class,'login']); 
   
   Route::group(['middleware' => ['admin']],function(){
         Route::get('dashboard',[AdminController::class,'dashboard']);
         Route::get('settings',[AdminController::class,'settings']);
         Route::get('logout',[AdminController::class,'logout']);
         Route::post('/check-current-pwd',[AdminController::class,'checkCurrentPassword']);
        // Route::post('/update-current-pwd',[AdminController::class,'updateCurrentPassword']);
        Route::post('/update-current-pwd','AdminController@updateCurrentPassword')->name('update-current-pwd');
   });


});