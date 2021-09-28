<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\RoomController;
use App\Http\Controllers\api\room_micsController;



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






// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });






Route::group([
    'prefix' => 'auth'
    
], function ($router) {
 
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});


Route::post('/rooms/destroy/{id}',[RoomController::class,'destroy'])->middleware('jwt.auth');

Route::resource('rooms', RoomController::class)->middleware('jwt.auth');

Route::resource('room_mics', room_micsController::class)->middleware('jwt.auth');