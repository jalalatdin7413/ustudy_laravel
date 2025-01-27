<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

//Route::middleware('auth:sanctum')->get('/getMe', [AuthController::class, 'getMe']);

Route::prefix('core/v1')->group(base_path('routes/core/api_v1.php'));