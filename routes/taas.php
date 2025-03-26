<?php

use App\Http\Controllers\Brief;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    
})->name('welcome');


Route::get('/brief', Brief::class)->name('brief');
Route::post('/brief', [Brief::class, 'store'])->name('brief.store');
