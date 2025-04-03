<?php

use App\Http\Controllers\Brief;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TechnologyController;

Route::get('/', function () {
    return view('welcome');
    
})->name('welcome');


Route::get('/brief', Brief::class)->name('brief');
Route::post('/brief', [Brief::class, 'store'])->name('brief.store');

Route::get('/service', ServiceController::class)->name('service.index');

Route::get('/technology', TechnologyController::class)->name('technology.index');
Route::get('/technology/{name}/{slug}', [TechnologyController::class, 'show'])->name('technology.article');