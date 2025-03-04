<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    
})->name('welcome');

Route::get('/rtl', function () {
    return view('welcome-rtl');
    
});
