<?php

namespace App\Managers;

use App\Managers\Contracts\WinnerManager as WinnerManagerContract;

class WinnerManager implements WinnerManagerContract
{
    public function hasWinner(array $grid): bool
    {
        $winningCombinations = config('game.winning_combinations');

        foreach ($winningCombinations as $combination) {
            if ($grid[$combination[0]] !== null
                && $grid[$combination[0]] === $grid[$combination[1]]
                && $grid[$combination[1]] === $grid[$combination[2]]) {
                return true;
            }
        }

        return false;
    }

    public function isDraw(array $grid): bool
    {
        return !in_array(null, $grid, true);
    }
}
