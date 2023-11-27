<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/send-sms', [SmsApiController::class, 'sendSms']);
Route::get('/coucou', [SmsApiController::class, 'coucou']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
