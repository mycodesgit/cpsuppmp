<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PDFprController;
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
        Route::get('/category/list', [CategoryController::class, 'categoryRead'])->name('categoryRead');
        Route::post('/category/list/add', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
        Route::get('/category/list/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('categoryEdit');
        Route::post('/category/list/update', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::get('/category/list/delete{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete');



        Route::get('/unit/list', [UnitController::class, 'unitRead'])->name('unitRead');
        Route::post('/unit/list/add', [UnitController::class, 'unitCreate'])->name('unitCreate');
        Route::get('/unit/list/edit/{id}', [UnitController::class, 'unitEdit'])->name('unitEdit');
        Route::post('/unit/list/update', [UnitController::class, 'unitUpdate'])->name('unitUpdate');
        Route::get('/unit/list/delete{id}', [UnitController::class, 'unitDelete'])->name('unitDelete');


        Route::get('/item/list', [ItemController::class, 'itemRead'])->name('itemRead');
        Route::post('/item/list/add', [ItemController::class, 'itemCreate'])->name('itemCreate');
        Route::get('/item/list/edit/{id}', [ItemController::class, 'itemEdit'])->name('itemEdit');
        Route::post('/item/list/update', [ItemController::class, 'itemUpdate'])->name('itemUpdate');
        Route::get('/item/list/delete{id}', [ItemController::class, 'itemDelete'])->name('itemDelete'); 

        Route::get('/office/list', [OfficeController::class, 'officeRead'])->name('officeRead');
        Route::post('/office/list/add', [OfficeController::class, 'officeCreate'])->name('officeCreate');
        Route::get('/office/list/edit/{id}', [OfficeController::class, 'officeEdit'])->name('officeEdit');
        Route::post('/office/list/update', [OfficeController::class, 'officeUpdate'])->name('officeUpdate');
        Route::get('/office/list/delete{id}', [OfficeController::class, 'officeDelete'])->name('officeDelete'); 
    });

    //Request
    Route::prefix('/request')->group(function () {
        Route::get('/pendingPR_list', [RequestController::class, 'pending_list'])->name('pending_list');
        Route::get('/approvedPR_list', [RequestController::class, 'approved_list'])->name('approved_list');
        Route::get('/pdfPRform/view', [PDFprController::class, 'PDFprRead'])->name('PDFprRead');
        Route::get('/pdfPRformTemplate/view', [PDFprController::class, 'PDFprShowTemplate'])->name('PDFprShowTemplate');
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/list',[UserController::class,'user_list'])->name('user_list');
        Route::get('/account-settings',[UserController::class,'user_settings'])->name('user_settings');
    });
    
    //Logout
    Route::get('/logout',[MasterController::class,'logout'])->name('logout');
});
