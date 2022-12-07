<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login/user', [AuthController::class, 'login']);

Route::post('/register/admin', [AdminController::class, 'register']);
Route::post('/login/admin', [AdminController::class, 'login']); 



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout/user', [AuthController::class, 'logout']);
    Route::post('/logout/admin', [AdminController::class, 'logout']);
    Route::post('/kamar', [KamarController::class, 'store']);
    Route::get('/kamar/{id}', [KamarController::class, 'show']);
    Route::put('/kamar/{id}', [KamarController::class, 'update']);
    Route::delete('/kamar/{id}', [KamarController::class, 'destroy']);
    Route::get('/kamar', [KamarController::class, 'index']);
});