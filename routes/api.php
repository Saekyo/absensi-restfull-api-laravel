<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MediaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'signup']);

Route::group(['middleware' => 'auth:sanctum', 'abilities:admin'], function() {
    
    Route::middleware(['isLogin', 'CekRole:admin'])->group(function(){
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
        Route::put('/user/update/{id}', [UserController::class, 'update']);
        Route::get('/user/{id}', [UserController::class, 'getPerUser']);
        Route::get('/user', [UserController::class, 'index']);
    
        Route::get('/announcement', [AnnouncementController::class, 'index']);
        Route::post('/announcement/create', [AnnouncementController::class, 'store']);
        Route::put('/announcement/{id}', [AnnouncementController::class, 'update']);
        Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy']);
        
        Route::post('posts', [AuthenticationController::class, 'store']);                                                                                               
    });



});
// Route::middleware('isLogin')->group(function(){
    Route::post('/media/post', [MediaController::class, 'store']);
// });


