<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Brief;
use App\Http\Controllers\CallActionController;
use App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\Welcome;

Route::get('/', Welcome::class)->name('welcome');

Route::get('/brief', Brief::class)->name('brief');
Route::post('/brief', [Brief::class, 'store'])->name('brief.store');

Route::get('/service', ServiceController::class)->name('service.index');
Route::get('/service/{name}/{slug}', [ServiceController::class, 'show'])->name('service.article');

Route::get('/technology', TechnologyController::class)->name('technology.index');
Route::get('/technology/{name}/{slug}', [TechnologyController::class, 'show'])->name('technology.article');

Route::get('/process', ProcessController::class)->name('process');
Route::get('/about', AboutController::class)->name('about');

Route::get('/c/{id}', Customer::class)->name('customer');


