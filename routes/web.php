<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlowerController;
use App\Models\Flower;

Route::get('/', function () {
    $posts = [];
    $flowers = [];

    // Check if user is authenticated
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    // Fetch flowers from the database
    $flowers = Flower::all();

    return view('home', ['posts' => $posts, 'flowers' => $flowers]);
});

// User authentication routes
Route::get('/login', function () {
    return view('login'); // Create this view for login
});
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
