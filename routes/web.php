<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GameController::class, 'index'])->name('welcome');
Route::get('/new-game', [GameController::class, 'newGame'])->name('new-game');
Route::get('/journal-game', [GameController::class, 'journalGame'])->name('journal-game');
Route::post('/new-process', [GameController::class, 'store'])->name('new-process');
Route::post('/session-next', [GameController::class, 'nextStore'])->name('session-next');
Route::post('/session-previous', [GameController::class, 'previousStore'])->name('session-previous');
Route::get('/get-game-detail/{id}', [GameController::class, 'show']);