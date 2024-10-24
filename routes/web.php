<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlowerController;
use App\Models\Flower;

// Home route with a name
Route::get('/', function () {
    $posts = [];
    $flowers = Flower::all();

    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts, 'flowers' => $flowers]);
})->name('home');
// User authentication routes

Route::get('/login', function () {
    return view('login'); 
})->name('login'); 

Route::get('/register', function () {
    return view('register'); 
})->name('register');

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);


// Flower routes
Route::get('/flowers/create', [FlowerController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');

// Resource route for flowers (handles index, edit, update, destroy)
Route::resource('flowers', FlowerController::class)->except(['create', 'store']);