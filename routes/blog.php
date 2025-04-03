<?php

use App\Http\Controllers\Article;
use App\Models\Technology;
use Illuminate\Support\Facades\Route;


Route::get('article/{slug}/{id}', [Article::class, 'show'])->name('blog.article');


Route::get('/', Article::class)->name('blog.index');
