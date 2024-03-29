<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CarsController;
use App\Http\Controllers\Api\CarSpecificController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProfileController;
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

//Public API's
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [CustomerController::class, 'store'])->name('user.store');
Route::get('/cars', [CarsController::class, 'index']);
Route::get('/cars/{id}', [CarsController::class, 'show']);
Route::get('/branch', [BranchController::class, 'index']);
Route::get('/branch/{id}', [BranchController::class, 'show']);


//Private API's
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);


    //Admin API's
    Route::controller(CarsController::class)->group(function () {
        Route::post('/cars',                  'store')->name('cars.store');
        Route::put('/cars/{id}',              'update')->name('cars.update');
        Route::put('/cars/image/{id}',        'image')->name('cars.image');
        Route::delete('/cars/{id}',           'destroy');
    });

    Route::controller(BranchController::class)->group(function () {
        Route::post('/branch',            'store');
        Route::put('/branch/{id}',        'update');
        Route::delete('/branch/{id}',     'destroy');
    });
    
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/user',                     'index');
        Route::get('/user/{id}',                'show'); 
        Route::put('/user/{id}',                'update')->name('user.update');
        Route::put('/user/email/{id}',          'email')->name('user.email');
        Route::put('/user/phone/{id}',          'phone_number')->name('user.phone');
        Route::put('/user/address/{id}',        'address')->name('user.address');
        Route::put('/user/password/{id}',       'password')->name('user.password');
        Route::put('/user/image/{id}',          'image')->name('user.image');
        Route::delete('/user/{id}',             'destroy');
    });

    //User specific
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/show',                     'show');
        Route::put('/profile/image',                     'image')->name('profile.image');
    });

    //Car specific
    Route::controller(CarSpecificController::class)->group(function () {
        Route::get('/car/profile/show',                     'show');
        //Route::put('/profile/image',                     'image')->name('profile.image');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact',                     'index');
        Route::get('/contact/{id}',                'show'); 
        Route::post('/contact',                       'store');

    });

    Route::controller(OrdersController::class)->group(function () {
        Route::get('/order',             'index');
        Route::get('/order/{id}',         'show');
        Route::post('/order',            'store')->name('order.store');
        Route::put('/order/{id}',        'update')->name('order.update');
        Route::delete('/order/{id}',     'destroy');
    });

    Route::controller(OrderDetailsController::class)->group(function () {
        Route::get('/details',             'index');
        Route::get('/details/{id}',         'show');
        Route::post('/details',            'store');
    });
   
});
