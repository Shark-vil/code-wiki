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


Route::get('categories/get/{id?}', [
    App\Http\Controllers\Api\CategoriesController::class, 'get'
])->name('api.categories.get');

Route::middleware('api.token')->post('categories/delete/{id}', [
    App\Http\Controllers\Api\CategoriesController::class, 'delete'
])->name('api.categories.delete');

Route::middleware('api.token')->post('categories/update/{id}', [
    App\Http\Controllers\Api\CategoriesController::class, 'update'
])->name('api.categories.update');

Route::middleware('api.token')->post('categories/create', [
    App\Http\Controllers\Api\CategoriesController::class, 'create'
])->name('api.categories.create');

Route::get('pages/get/{id?}', [
    App\Http\Controllers\Api\PagesController::class, 'get'
])->name('api.pages.get');

Route::middleware('api.token')->post('pages/create', [
    App\Http\Controllers\Api\PagesController::class, 'create'
])->name('api.pages.create');