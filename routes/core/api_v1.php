<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('guest:sanctum')->group(function () {
   
   Route::post('login', [AuthController::class, 'login']);
});

 
Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::get('test2', function() {
       return 'authorized';
    });
});




Route::get('posts', [PostController::class, 'posts']);
