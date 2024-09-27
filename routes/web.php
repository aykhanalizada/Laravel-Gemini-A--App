<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::view('/','gemini')->name('home');

Route::post('/question',[GeminiController::class,'gemini'])->name('gemini');
