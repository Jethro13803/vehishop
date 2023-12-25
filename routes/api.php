<?php

use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CarsController;
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

//Public API's
Route::get('/cars', [CarsController::class, 'index']);
Route::get('/cars/{id}', [CarsController::class, 'show']);
Route::get('/branch', [BranchController::class, 'index']);
Route::get('/branch/{id}', [BranchController::class, 'show']);


Route::controller(CarsController::class)->group(function () {
    Route::post('/cars',            'store');
    Route::put('/cars/{id}',        'update');
    Route::delete('/cars/{id}',     'destroy');
});

Route::controller(BranchController::class)->group(function () {
    Route::post('/branch',            'store');
    Route::put('/branch/{id}',        'update');
    Route::delete('/branch/{id}',     'destroy');
});
