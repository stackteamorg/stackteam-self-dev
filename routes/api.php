<?php

use App\Http\Controllers\Article;
use Illuminate\Support\Facades\Route;

Route::put('blog/update-content/{id}', [Article::class, 'updateContent'])->name('articles.update');//->middleware('auth');


Route::post('blog/upload-image/{id}', [Article::class, 'uploadImage'])->name('articles.upload-image');






