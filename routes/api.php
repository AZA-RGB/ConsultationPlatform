<?php

// use App\Http\Controllers\Api\ExpertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UserController;
// use Illuminate\Http\Resources\ExpertResource;
// use App\Models\Expert;


Route::prefix('expert')->group(function () {

Route::post('register',[ExpertController::class,'register']);
Route::post('login',[ExpertController::class,'login']);
Route::post('experts_consultation',[ExpertController::class,'expertsConsultation']);
Route::post('search_experts',[ExpertController::class,'searchExpert']);
Route::post('show_expert',[ExpertController::class,'showExpertDetails']);
Route::post('test',[ExpertController::class,'availabletimes'])->name('test');

});


Route::prefix('user')->group(function () {

    Route::post('register',[UserController::class,'register']);
    Route::post('login',[UserController::class,'login']);
});



