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
    return view('login'); // Ensure you have a 'login.blade.php' view
})->name('login'); // Add this line to name the route

Route::get('/register', function () {
    return view('register'); // Ensure you have a 'register.blade.php' view created
})->name('register');

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);// Ensure the register route is named


// Flower routes
Route::get('/flowers/create', [FlowerController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');

// Resource route for flowers (handles index, edit, update, destroy)
Route::resource('flowers', FlowerController::class)->except(['create', 'store']);