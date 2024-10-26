<?php

namespace App\Repositories\Contracts;

use App\Models\Game;

interface GameRepository
{
    public function createNewGame(array $attributes): Game;

    public function updateGame(Game $game, array $attributes): Game;
}
