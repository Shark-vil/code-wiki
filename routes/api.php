<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api.token')->get('categories', [
    App\Http\Controllers\Api\CategoriesController::class, 'index'
])->name('api.categories.get');

Route::middleware('api.token')->delete('categories/{id}', [
    App\Http\Controllers\Api\CategoriesController::class, 'destroy'
])->name('api.categories.destroy');