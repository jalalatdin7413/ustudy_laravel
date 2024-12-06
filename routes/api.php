<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('posts', [PostController::class, 'posts']);