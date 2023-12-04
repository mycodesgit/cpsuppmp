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
use App\Http\Controllers\RequestPendingController;
use App\Http\Controllers\RequestApprovedController;
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
        Route::get('/purchaseRequest/purpose', [RequestController::class, 'prPurposeRequest'])->name('prPurposeRequest');
        Route::post('/purchaseRequest/purpose/add', [RequestController::class, 'prPurposeRequestCreate'])->name('prPurposeRequestCreate');

        Route::get('/purchaseRequest/{purpose_Id}', [RequestController::class, 'prCreateRequest'])->name('prCreateRequest');
        Route::post('/purchaseRequest/add', [RequestController::class, 'prCreate'])->name('prCreate');
        Route::get('get-items/{id}', [RequestController::class, 'getItemsByCategory'])->name('getItemsByCategory');
        Route::post('/purchaseRequest/add/save', [RequestController::class, 'savePR'])->name('savePR');
        Route::get('/purchaseRequest/delete/{id}', [RequestController::class, 'itemreqDelete'])->name('itemreqDelete');

        Route::get('/pendingPR_list', [RequestPendingController::class, 'pendingListRead'])->name('pendingListRead');
        Route::get('/pendingPR_list/view/{pid}', [RequestPendingController::class, 'pendingListView'])->name('pendingListView');
        Route::get('/pendingPR_list/pdf/{pid}', [RequestPendingController::class, 'PDFprPending'])->name('PDFprPending');

        Route::get('/pendingPR/list', [RequestPendingController::class, 'pendingAllListRead'])->name('pendingAllListRead');
        Route::get('/pendingPR/list/ajax', [RequestPendingController::class, 'getpendingAllListRead'])->name('getpendingAllListRead');
        Route::get('/pendingPR/list/view/{pid}', [RequestPendingController::class, 'pendingAllListView'])->name('pendingAllListView');
        Route::get('/pendingPR/list/pdf/{pid}', [RequestPendingController::class, 'PDFprAllPending'])->name('PDFprAllPending');
        Route::post('/pendingPR/list/approved', [RequestPendingController::class, 'approvedPR'])->name('approvedPR');

        Route::get('/approvedPR_list', [RequestApprovedController::class, 'approvedListRead'])->name('approvedListRead');
        Route::get('/approvedPR_list/view/{pid}', [RequestApprovedController::class, 'approvedListView'])->name('approvedListView');
        Route::get('/approvedPR_list/pdf/{pid}', [RequestApprovedController::class, 'PDFprApproved'])->name('PDFprApproved');

        Route::get('/approvedPR/list', [RequestApprovedController::class, 'approvedListAllRead'])->name('approvedListAllRead');
        Route::get('/approvedPR/list/view/{pid}', [RequestApprovedController::class, 'approvedListView'])->name('approvedListView');
        Route::get('/approvedPR/list/pdf/{pid}', [RequestApprovedController::class, 'PDFprApproved'])->name('PDFprApproved');

        Route::get('/pdfPRform/view', [PDFprController::class, 'PDFprRead'])->name('PDFprRead');
        Route::get('/pdfPRformTemplate/view', [PDFprController::class, 'PDFprShowTemplate'])->name('PDFprShowTemplate');

        Route::get('/pdfBARSform/view', [PDFprController::class, 'PDFbarsRead'])->name('PDFbarsRead');
        Route::get('/pdfBARSformTemplate/view', [PDFprController::class, 'PDFbarsShowTemplate'])->name('PDFbarsShowTemplate');
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/list',[UserController::class,'user_list'])->name('user_list');
        Route::post('/list/add', [UserController::class, 'userCreate'])->name('userCreate');
        Route::get('/account-settings',[UserController::class,'user_settings'])->name('user_settings');
        Route::post('/account-settings/information/update',[UserController::class,'user_settings_profile_update'])->name('user_settings_profile_update');
        Route::post('/acccount-settings/information/updatePass',[UserController::class,'profilePassUpdate'])->name('profilePassUpdate');
    });
    
    //Logout
    Route::get('/logout',[MasterController::class,'logout'])->name('logout');
});
