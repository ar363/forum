<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Spatie\Tags\Tag;
use App\Models\Comment;
use App\Models\Category;
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


Route::get('/profile/{user}', function (User $user) {

    $commentCount = Comment::where(['created_by' => $user->id])->count();
    $postCount = Post::where(['created_by' => $user->id])->count();

    return Inertia::render('UserProfile', [
        'profile' => $user,
        'stats' => [
            'comments' => $commentCount,
            'posts' => $postCount,
        ]
    ]);
})->whereNumber('id')->name('profile');


Route::get('/tag/{slug}', function ($slug) {
    return Inertia::render('TagPage', [
        'tag' => $slug,
        'posts' => Post::withAnyTags([$slug])
            ->latest()
            ->paginate(15),
    ]);
})->name('tag');


Route::get('/category/{slug}', function ($slug) {
    $category = Category::where(['slug' => $slug])->firstOrFail();

    return Inertia::render('CategoryPage', [
        'category' => $category,
        'posts' => Post::whereBelongsTo($category)
            ->latest()
            ->paginate(15),
    ]);
})->name('category');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('discussion', PostController::class, ['except' => ['index', 'show']]);
    Route::resource('reply', CommentController::class, ['only' => ['store', 'destroy']]);
});


Route::resource('discussion', PostController::class, ['only' => ['show']]);
