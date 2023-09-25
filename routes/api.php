<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;







Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::prefix('event')->group(function () {
    Route::get('/', [EventController::class, 'getEvents']);
    Route::get('/{id}', [EventController::class, 'getEventsById']);
    Route::post('/insert', [EventController::class, 'insertEvents']);
    Route::put('/update/{id}', [EventController::class, 'updateEvents']);
    Route::delete('/delete/{id}', [EventController::class, 'deleteEvents']);
});







Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('user-profile', [AuthController::class,'userProfile']);
    Route::post('user-profile', [AuthController::class,'userProfile']);
    Route::post('logout', [AuthController::class,'logout']);

});






