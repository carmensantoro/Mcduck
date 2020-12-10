<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\RequestRevisorController;

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
// Lista annunci
Route::get('/ads/index/{category}', [AdController::class, 'index'])->name('ads.index');
// Creazione e salvataggio
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads/store', [AdController::class, 'store'])->name('ads.store');
// Dettaglio annuncio
Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');

// Annunci filtrati per categoria
// Route::get('ads/index/{category}', [AdController::class, 'index'])->name('adscategory.index');

// Rotta ricerca libera
Route::get('/search', [AdController::class, 'search'])->name('ads.search');
//rotte per revisore
Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index');
Route::post('revisor/ad/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('revisor/ad/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');

//Rotta pagina form per revisore
Route::get('/revisor/form_request', [RequestRevisorController::class, 'formRequest'])->name('revisor.formRequest');
Route::post('/revisor/request', [RequestRevisorController::class, 'request'])->name('revisor.request');