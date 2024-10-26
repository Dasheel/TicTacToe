<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Contracts\GameRepository as GameRepositoryContract;

class GameRepository implements GameRepositoryContract
{
    public function createNewGame(array $attributes): Game
    {
        return Game::create($attributes);
    }

    public function updateGame(Game $game, array $attributes): Game
    {
        $game->update($attributes);

        return $game;
    }
}
