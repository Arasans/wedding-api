<?php

use App\Http\Controllers\loginAdminController;
use App\Http\Controllers\loginUserController;
use App\Http\Controllers\regisWeddingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('user', loginUserController::class);
Route::apiResource('admin', loginAdminController::class);
Route::apiResource('wedding', regisWeddingController::class);
Route::post('loginUser', [loginUserController::class, 'login']);
Route::post('loginAdmin', [loginAdminController::class, 'login']);
