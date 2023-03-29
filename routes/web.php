<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [PostController::class, 'index'])->name('posts.dashboard');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.showpost');

Route::middleware('auth')->group(function () {

    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/dashboard', [PostController::class, 'submit'])->name('posts.submit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/login', function () {
  return view('auth.login');
});

require __DIR__.'/auth.php'; 
?>