<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/languageConverter/{locale}', function ($locale) {
    if(in_array($locale, ["ar", "fr", "en"])){
        session()->put("locale", $locale);
    };
    return redirect()->back();
})->name("languageConverter");

Route::view('/powergrid', 'powergrid-demo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
});

require __DIR__.'/auth.php';
