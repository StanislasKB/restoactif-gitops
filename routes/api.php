<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebPushController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register/community/token', [AuthController::class,'register_notification_token']);
Route::post('/test-notification', [WebPushController::class,'sendPushNotification']);

