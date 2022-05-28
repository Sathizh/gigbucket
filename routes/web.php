<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingsController;

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
Route::get('/', [ListingsController::class, 'index']);
// Route::get('/', function () {
//     return view('listings', [
//         'heading' => 'Latest listings',
//         'listings'=> Listing::all(),
//     ]);
// });
Route::post('/listings', [ListingsController::class, 'store'])->middleware('auth');
Route::get('/listings/manage', [ListingsController::class, 'manage'])->middleware('auth');
Route::get('/listings/create', [ListingsController::class, 'create'])->middleware('auth');
Route::get('/listings/{listing}', [ListingsController::class, 'show']);
Route::put('/listings/{listing}', [ListingsController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy'])->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit'])->middleware('auth');

// register form CREATE
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('users/authenticate', [UserController::class, 'authenticate']);


