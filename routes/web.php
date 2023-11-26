<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('connexion');
});
Route::prefix('auth')->group(function () {
    Route::post('/check', [AuthController::class, 'check']);
});

Route::group(['middleware' => ['logged']], function () {

    Route::get('/administration', [AdminController::class, 'index']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/stats', [AdminController::class, 'stats']);
    Route::get('/liste_sims', [AdminController::class, 'liste_sims']);

    Route::get('/logout', [AuthController::class, 'logout']);
});
