<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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

// Guest Routes
Route::redirect('/', '/login');

Route::redirect('/home', '/dashboard');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated Routes - Universal Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'penulis') {
            return redirect('/writer/dashboard');
        } else {
            return redirect('/visitor/dashboard');
        }
    })->name('dashboard');

    // Article viewing (accessible to all authenticated users)
    Route::get('/search', [VisitorController::class, 'search'])->name('search');
    Route::get('/category/{id}', [VisitorController::class, 'category'])->name('category');
    Route::get('/article/{slug}', [VisitorController::class, 'article'])->name('article');
    Route::get('/profile/{username}', [VisitorController::class, 'profile'])->name('profile');
});

// Visitor Routes
Route::middleware(['auth', 'role:pengunjung'])->prefix('visitor')->name('visitor.')->group(function () {
    Route::get('/dashboard', [VisitorController::class, 'dashboard'])->name('dashboard');
    Route::post('/article/{postId}/comment', [VisitorController::class, 'addComment'])->name('comment');
});

// Writer Routes
Route::middleware(['auth', 'role:penulis'])->prefix('writer')->name('writer.')->group(function () {
    Route::get('/dashboard', [WriterController::class, 'dashboard'])->name('dashboard');
    
    // Articles Management
    Route::get('/articles', [WriterController::class, 'articles'])->name('articles');
    Route::get('/articles/create', [WriterController::class, 'createArticle'])->name('create');
    Route::post('/articles', [WriterController::class, 'storeArticle'])->name('store');
    Route::get('/articles/{id}/edit', [WriterController::class, 'editArticle'])->name('edit');
    Route::put('/articles/{id}', [WriterController::class, 'updateArticle'])->name('update');
    Route::delete('/articles/{id}', [WriterController::class, 'deleteArticle'])->name('delete');
    
    // Comments Management
    Route::get('/comments', [WriterController::class, 'comments'])->name('comments');
    Route::post('/comments/{commentId}/reply', [WriterController::class, 'replyComment'])->name('reply');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Categories Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    
    // Posts Management
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::get('/posts/{id}/edit', [AdminController::class, 'editPost'])->name('posts.edit');
    Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('posts.delete');
});

// API Token Authentication (kept for backward compatibility)
Route::get('/auth/token/{token}', function ($token) {
    $personalToken = PersonalAccessToken::findToken($token);
    
    if ($personalToken && $personalToken->user) {
        Auth::login($personalToken->user);
        return redirect('/dashboard');
    }
    
    return redirect('/login')->with('error', 'Token tidak valid');
})->name('auth.token');

