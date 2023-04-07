<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function() {
    Route::post('/',[\App\Http\Controllers\Api\UserController::class,'store'])->name('user.store');
    Route::get('/{id}',[\App\Http\Controllers\Api\UserController::class,'show'])->name('user.show');
    });
Route::prefix('post')->group(function() {
    Route::post('/',[\App\Http\Controllers\Api\PostController::class,'store'])->name('post.store');
    Route::get('/{id}',[\App\Http\Controllers\Api\PostController::class,'show'])->name('post.show');
    Route::post('/{id}/comment',[\App\Http\Controllers\Api\PostController::class,'comment'])->name('post.comment');

});

Route::prefix('video')->group(function() {
    Route::post('/',[\App\Http\Controllers\Api\VideoController::class,'store'])->name('video.store');
    Route::get('/{id}',[\App\Http\Controllers\Api\VideoController::class,'show'])->name('video.show');
    Route::post('/{id}/comment',[\App\Http\Controllers\Api\VideoController::class,'comment'])->name('video.comment');

});
