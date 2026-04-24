<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\SplashController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SplashController::class, 'index'])->name('splash');
Route::get('/game/{gameId}', [GameController::class, 'show'])->name('game.show');
Route::get('/print/{gameId}/board', [PrintController::class, 'board'])->name('print.board');
Route::get('/print/{gameId}/cards', [PrintController::class, 'cards'])->name('print.cards');
