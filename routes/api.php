<?php

use App\Http\Controllers\Article;
use Illuminate\Support\Facades\Route;

Route::post('blog/update-content/{id}', [Article::class, 'updateContent'])->name('articles.update');






