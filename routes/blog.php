<?php

use App\Http\Controllers\Article;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/{slug}/{id}', Article::class )->name('blog.article');
Route::get('/', Article::class )->name('blog.index');
