<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/articles')->group(function () {
    Route::get('/t/', [ArticleController::class, 'index']);
    Route::get('/t/{article}', [ArticleController::class, 'show']);
    Route::post('/store', [ArticleController::class, 'store']);
    Route::put('/update/{article}', [ArticleController::class, 'update']);
    Route::delete('/delete/{article}', [ArticleController::class, 'delete']);
    Route::delete('/delete', [ArticleController::class, 'bulkDelete']);
    Route::post('{article}/attach', [ArticleController::class,'attach']);
});

Route::prefix('/tags')->group(function () {
    Route::get('/', [TagController::class, 'index']);
    Route::get('/{tag:name}', [TagController::class, 'show']);
    Route::post('/store', [TagController::class, 'store']);
    Route::put('/update/{tag:name}', [TagController::class, 'update']);
    Route::delete('/delete/{tag:name}', [TagController::class, 'delete']);
    Route::post('/delete', [TagController::class, 'bulkDelete']);
});

