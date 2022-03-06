<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('dashboard');
    Route::post('/uploadFile', [PictureController::class, 'upload']);
    Route::post('/savePost', [PostController::class, 'store']);
});

require __DIR__.'/auth.php';
