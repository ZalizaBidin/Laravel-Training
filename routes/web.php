<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;

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
    return view('welcome');
});

Route::get('/stafflogin', function () {
    return view('staff.stafflogin');
});

Route::post('/stafflogin', function () {
    return view('staff.stafflogin');
});

Route::get('/driverlist', function () {
    return view('driverlist');
});

Route::group(['prefix' => 'user'], function() {
    Route::post('/fetchAll', [ReportController::class, 'fetchAll']);
    Route::post('/edit', [ReportController::class, 'edit']);
    Route::post('/update', [ReportController::class, 'update']);
    Route::post('/store', [ReportController::class, 'store']);
    Route::post('/delete', [ReportController::class, 'destroy']);
});

Route::get('/reportlist', function () {
    return view('reportlist');
});

Route::get('/statuslist', function () {
    return view('statuslist');
});

Route::get('/trace_user_from_status', function () {
    return view('trace_user_from_status');
});