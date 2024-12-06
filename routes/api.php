<?php


use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;


Route::prefix('core/v1')->group(base_path('routes/core/api_v1.php'));