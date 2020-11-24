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
    return view('welcome');
});

$AUTH_REGISTER = env('AUTH_REGISTER');
Auth::routes([
    'register' => $AUTH_REGISTER,
    'reset' => $AUTH_REGISTER,
    'verify' => $AUTH_REGISTER,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories',
    [App\Http\Controllers\CategoriesController::class, 'index'])
    ->name('categories');
