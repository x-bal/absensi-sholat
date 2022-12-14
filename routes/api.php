<?php

use App\Http\Controllers\Api\ApiController;
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

Route::get('/get-mode', [ApiController::class, 'getmode']);
Route::get('/add-card', [ApiController::class, 'addcard']);
Route::get('/absensi', [ApiController::class, 'absensi']);
Route::get('/time', [ApiController::class, 'time']);
