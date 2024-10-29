<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//1 dakika içinde 60 istekten fazla yapılmaması için throttle middleware kullanıldı.
Route::middleware('throttle:60,1')->group(function () {

    Route::get('/', [\App\Http\Controllers\web\LocationWebController::class, 'index']);

});
