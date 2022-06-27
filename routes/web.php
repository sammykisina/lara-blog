<?php

use Illuminate\Support\Facades\Route;

Route::view(uri: '/', view: 'welcome')->name(name:'home');

/**
 * Post Routes
 */
Route::prefix('posts')->as('posts:')->group(function () {
  Route::post('/',App\Http\Controllers\Web\Posts\StoreController::class)->name('store');
});
