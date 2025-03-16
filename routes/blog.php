<?php

use App\Http\Controllers\Article;
use Illuminate\Support\Facades\Route;

// در اینجا نیازی به تعریف {locale} نیست چون در bootstrap/app.php به صورت
// Route::prefix('{locale}/blog') تعریف شده است
Route::get('article/{slug}/{id}', [Article::class, 'show'])->name('blog.article');
Route::get('/', Article::class)->name('blog.index');
