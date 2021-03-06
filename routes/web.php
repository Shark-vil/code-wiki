<?php

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
    return redirect()->route('wiki');
});

$AUTH_REGISTER = env('AUTH_REGISTER');
Auth::routes([
    'register' => $AUTH_REGISTER,
    'reset' => $AUTH_REGISTER,
    'verify' => $AUTH_REGISTER,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wiki/{id?}', [App\Http\Controllers\HomeController::class, 'wiki'])->name('wiki');

Route::get('/categories',
    [App\Http\Controllers\CategoriesController::class, 'index'])
    ->name('categories');

Route::get('/categories/edit/{id}',
    [App\Http\Controllers\CategoriesController::class, 'edit'])
    ->name('categories.edit');

Route::get('/categories/create',
    [App\Http\Controllers\CategoriesController::class, 'create'])
    ->name('categories.create');

    
Route::get('/pages',
    [App\Http\Controllers\PagesController::class, 'index'])
    ->name('pages');

Route::get('/pages/edit/{id}',
    [App\Http\Controllers\PagesController::class, 'edit'])
    ->name('pages.edit');

Route::get('/pages/create',
    [App\Http\Controllers\PagesController::class, 'create'])
    ->name('pages.create');