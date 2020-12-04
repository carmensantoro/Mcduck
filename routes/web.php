<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

//Rotte per annunci
Route::get('/ads/index', [AdController::class, 'index'])->name('ads.index');

Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads/store', [AdController::class, 'store'])->name('ads.store');