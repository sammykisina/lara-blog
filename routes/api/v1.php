<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * V1 Post Endpoints
 */
Route::prefix('posts')->as('posts:')->group(function() {
    Route::get('/',App\Http\Controllers\Api\V1\Posts\IndexController::class)->name('index'); // route('api:v1:posts:index')
    Route::get('{post:uuid}',App\Http\Controllers\Api\V1\Posts\ShowController::class)->name('show'); // route('api:v1:posts:show')
    Route::post('/',App\Http\Controllers\Api\V1\Posts\StoreController::class)->name('store'); // route('api:v1:posts:store')
    Route::patch('{post:uuid}',App\Http\Controllers\Api\V1\Posts\UpdateController::class)->name('update'); // route('api:v1:posts:update')
    Route::delete('{post:uuid}',App\Http\Controllers\Api\V1\Posts\DeleteController::class)->name('delete'); // route('api:v1:posts:delete')
});
