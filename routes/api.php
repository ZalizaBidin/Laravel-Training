<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;

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

Route::post('/stafflogin', function (Request $request) {
    $name=$request->name;
    return response()->json([
        'name' => $name,
        'status' => 200,
    ]); 
});

Route::group(['prefix' => 'driver'], function() {
    Route::post('/fetchAll', [DriverController::class, 'fetchAll']);
    Route::post('/edit', [DriverController::class, 'edit']);
    Route::post('/update', [DriverController::class, 'update']);
    Route::post('/store', [DriverController::class, 'store']);
    Route::post('/delete', [DriverController::class, 'destroy']);
});


Route::group(['prefix' => 'report'], function() {
    Route::post('/fetchAll', [ReportController::class, 'fetchAll']);
    Route::post('/edit', [ReportController::class, 'edit']);
    Route::post('/update', [ReportController::class, 'update']);
    Route::post('/store', [ReportController::class, 'store']);
    Route::post('/delete', [ReportController::class, 'destroy']);
    Route::post('/test', [ReportController::class, 'test']);
});

Route::group(['prefix' => 'status'], function() {
    Route::post('/fetchAll', [StatusController::class, 'fetchAll']);
    Route::post('/edit', [StatusController::class, 'edit']);
    Route::post('/update', [StatusController::class, 'update']);
    Route::post('/store', [StatusController::class, 'store']);
    Route::post('/delete', [StatusController::class, 'destroy']);
    Route::post('/trace_user_from_status', [StatusController::class, 'trace_user_from_status']);
});