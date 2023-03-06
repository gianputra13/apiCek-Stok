<?php

use App\Http\Controllers\arsipController;
use App\Http\Controllers\StokController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('arsip', [arsipController::class, 'index']);
Route::post('stok', [StokController::class, 'store']);
Route::get('stok', [StokController::class, 'index']);
Route::post('stok/search', [StokController::class, 'show']);
Route::post('stok/update', [StokController::class, 'update']);
Route::delete('stok/{id}', [StokController::class, 'destroy']);