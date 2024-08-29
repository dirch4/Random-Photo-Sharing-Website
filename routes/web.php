<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
    Route::get('/sesi/registrasi', [SesiController::class, 'register']);
    Route::post('/sesi/create', [SesiController::class, 'create']);
});
Route::get('/home', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('admin');
    } else if (auth()->user()->role == 'owner') {
        return redirect('admin/owner');
    } else {
        return redirect('user');
    }
});
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('admin');
    } else if (auth()->user()->role == 'owner') {
        return redirect('admin/owner');
    } else {
        return redirect('user');
    }
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/upload', [UserController::class, 'viewupload']);
    Route::post('/user/upload', [UserController::class, 'upload']);

    Route::get('/admin', [AdminController::class, 'index'])->middleware(['roleAccess:admin']);
    Route::get('/admin/owner', [AdminController::class, 'owner'])->middleware(['roleAccess:owner']);

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
        // Routes for managing users
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    
        // Routes for managing content
        Route::get('/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
        Route::put('/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
        Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
    });
    

    Route::get(('/profile'), [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');

});

require __DIR__.'/auth.php';
