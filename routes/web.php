<?php

use Domain\Blogging\Reports\PostCreatedOverPeriod;
use Illuminate\Support\Facades\Route;
use Spatie\Period\Period;

Route::view(uri: '/', view: 'welcome')->name(name:'home');

Route::get('test',function () {
  $report = new PostCreatedOverPeriod (
    Period::make('2022-06-25','2022-06-27')
  );

  dd($report->totalPosts());
});

/**
 * Post Routes
 */
Route::prefix('posts')->as('posts:')->group(function () {
  Route::post('/',App\Http\Controllers\Web\Posts\StoreController::class)->name('store');
});
