<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::group(['prefix' => 'games', 'as' => 'games.'], static function () {
    Route::post('/', [GameController::class, 'startGame'])->name('start');
    Route::post('/{game}/move', [GameController::class, 'makeMove'])->name('move');
});
