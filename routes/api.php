<?php

use App\Http\Controllers\Article;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::put('blog/update-content/{id}', [Article::class, 'updateContent'])->name('articles.update');//->middleware('auth');

// API route for uploading article images
Route::post('blog/upload-image', [Article::class, 'uploadImage'])->name('articles.upload-image');

// API route for uploading user profile images
Route::post('user/upload-profile-image', [UserProfileController::class, 'uploadProfileImage'])->name('user.upload-profile-image');






