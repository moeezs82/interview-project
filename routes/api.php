<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FileController;
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

Route::post('/uploader', [FileController::class, 'upload']);
Route::get('/downloader', [FileController::class, 'download']);

Route::post('articles', [ArticleController::class, 'store']);
Route::get('articles/{id}', [ArticleController::class, 'get']);
Route::delete('articles/{id}', [ArticleController::class, 'delete']);
Route::put('articles/{id}', [ArticleController::class, 'update']);
