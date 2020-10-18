<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// use \BookController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/home', ['uses' => 'HomeController@index'])->name('home');

Route::get('book/studentBooks', [App\Http\Controllers\BookController::class, 'studentBooks']);

Route::get('book/{id}/borrow', [App\Http\Controllers\BookController::class, 'borrow']);

Route::post('book/{id}/returnDate', [App\Http\Controllers\BookController::class, 'setReturnDate']);

Route::post('book/{id}/return', [App\Http\Controllers\BookController::class, 'return']);

Route::resource('book', BookController::class);

Route::get('/user', [ UserController::class, 'index']);

Route::get('/user/{id}/show', [ UserController::class, 'show']);

Route::get('/user/searchres', [ UserController::class, 'search']);
