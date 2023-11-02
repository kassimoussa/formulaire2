<?php

use App\Http\Controllers\AdminController;
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
    return view('admin.connexion');
});
Route::prefix('auth')->group(function () {
    Route::post('/check', [AdminController::class, 'check']);
});

Route::group(['middleware' => ['logged']], function () {

    Route::get('/admin', function () {
        return view('admin.client_list');
    });
    
    Route::get('/logout', [AdminController::class, 'logout']);
});
