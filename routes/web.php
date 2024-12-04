<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserFormController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('Admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserFormController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserFormController::class, 'store'])->name('users.store');
    Route::get('/user/edit/{id}', [UserFormController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{id}/update', [UserFormController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}',[UserFormController::class, 'destroy'])->name('user.delete');
    Route::get('Products', [ProductController::class, 'index'])->name('products');
    Route::get('Products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('Products/create/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('Products/edit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('Products/edit/{product_id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('Products/delete/{product_id}', [ProductController::class, 'destroy'])->name('product.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

