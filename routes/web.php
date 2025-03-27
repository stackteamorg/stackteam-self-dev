<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TechnologyController;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route for article content updates
    
});


require __DIR__.'/auth.php';

Route::get('/service', ServiceController::class)->name('service.index');
Route::get('/technology', [TechnologyController::class, 'index'])->name('technology.index');


Route::middleware([SetLocale::class])->group(function () {

    Route::prefix('{locale}')
        ->group(base_path('routes/taas.php'));

    Route::prefix('{locale}/blog')
        ->group(base_path('routes/blog.php'));

});


