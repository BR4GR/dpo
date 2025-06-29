<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;

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

// Parking garage simulator routes
Route::prefix('parking')->name('parking.')->group(function () {
    Route::post('/arrival', [ParkingController::class, 'carArrived'])->name('arrival');
    Route::post('/departure', [ParkingController::class, 'carLeft'])->name('departure');
    Route::get('/status', [ParkingController::class, 'getCurrentStatus'])->name('status');
    Route::get('/events', [ParkingController::class, 'getAllEvents'])->name('events');
});
