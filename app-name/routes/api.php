<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\foodController;
use App\Http\Controllers\restaurantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(foodController::class)->group(function(){
    Route::get('/foods', 'getFoods');
    Route::post('/food', 'createFood');
    Route::get('/food/{id}', 'getFood');
    Route::put('/food/{id}', 'editFood');
    Route::delete('/food/{id}', 'deleteFood');
});

Route::controller(restaurantController::class)->group(function(){
    Route::get('/restaurants', 'getRestaurants');
    Route::post('/restaurant', 'createRestaurant');
    Route::get('/restaurant/{id}', 'getRestaurant');
    Route::put('/restaurant/{id}', 'editRestaurant');
    Route::delete('/restaurant/{id}', 'deleteRestaurant');
});
