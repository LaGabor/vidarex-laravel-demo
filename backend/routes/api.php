<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
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

Route::get('/unauthorized', [AuthController::class, 'notAuthenticated'])->name('unauthenticated');
Route::get('/device/all', [DeviceController::class, 'getAllDevices']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/device/new', [DeviceController::class, 'createNewDevice']);
    Route::delete('/device/delete', [DeviceController::class, 'deleteDeviceById'])->middleware('restrictRole:1');
    Route::put('/device/edit', [DeviceController::class, 'editDeviceById'])->middleware('restrictRole:1');
});


