<?php

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $latestPosts = Post::with('author')
    ->latest()
    ->paginate(15);

    return Inertia::render('Home', [
        'latestPosts' => $latestPosts,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('discussion', PostController::class, ['except' => ['index', 'show']]);
    Route::resource('reply', CommentController::class, ['only' => ['store']]);
});


Route::resource('discussion', PostController::class, ['only' => ['show']]);
