<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;


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
    return view('login');
});

//Login
Route::get('/login',[LoginController::class,'getLogin'])->name('getLogin');
Route::post('/login',[LoginController::class,'postLogin'])->name('postLogin');

//Middleware
Route::group(['middleware'=>['login_auth']],function(){
    Route::get('/dashboard',[MasterController::class,'dashboard'])->name('dashboard');

    //View
    Route::prefix('/view')->group(function () {
        // Route::get('/', [ViewController::class, 'index'])->name('manage-index');
        Route::get('/category', [ViewController::class, 'category_list'])->name('category_list');
        Route::get('/unit', [ViewController::class, 'unit_list'])->name('unit_list'); 
        Route::get('/item', [ViewController::class, 'item_list'])->name('item_list'); 

        Route::get('/offices', [ViewController::class, 'office_list'])->name('office_list'); 
    });

    //Request
    Route::prefix('/request')->group(function () {
        Route::get('/pendingPR_list', [RequestController::class, 'pending_list'])->name('pending_list');
        Route::get('/approvedPR_list', [RequestController::class, 'approved_list'])->name('approved_list');
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/list',[UserController::class,'user_list'])->name('user_list');
        Route::get('/account-settings',[UserController::class,'user_settings'])->name('user_settings');
    });
    
    //Logout
    Route::get('/logout',[MasterController::class,'logout'])->name('logout');
});
