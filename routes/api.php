<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//1 dakika içinde 60 istekten fazla yapılmaması için throttle middleware kullanıldı.
Route::middleware('throttle:60,1')->group(function () {
    Route::prefix("locations")->group(function () {


    });
});
