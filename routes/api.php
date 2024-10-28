<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//1 dakika içinde 60 istekten fazla yapılmaması için throttle middleware kullanıldı.
Route::middleware('throttle:60,1')->group(function () {

    Route::resource('locations', \App\Http\Controllers\LocationController::class)
        ->only(['store', 'show', 'update', 'index', 'destroy'])
        ->where(['location' => '[0-9]+']);

    Route::prefix('locations')->group(function () {
        Route::get('with-destroy', [\App\Http\Controllers\LocationController::class, 'withDestroy']);
        Route::post('route', [\App\Http\Controllers\DistanceController::class, 'route']);
    });

});
