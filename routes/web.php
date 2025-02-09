<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// route untuk ke home page
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// route untuk melihat profile
Route::get('/u/{user:username}', [ProfileController::class, 'index'])->name('profile');

// route untuk membuat community baru
// Route::get('/createcommunity', [CommunityController::class,'index'])->middleware(['auth','verified'])->name('createcommunity');

Route::post('/createpost', [PostController::class,'store'])->name('post.create');
Route::put('/createpost/{post}', [PostController::class,'update'])->name('post.update');
Route::delete('/createpost/{post}', [PostController::class,'destroy'])->name('post.destroy');
Route::post('/createpost/{post}/reaction', [PostController::class, 'postReaction'])->name('post.reaction');

Route::post('/createpost/{post}/comment', [PostController::class, 'createComment'])->name('post.comment.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/community', [CommunityController::class,'store'])->middleware(['auth','verified'])->name('community.create');


require __DIR__.'/auth.php';