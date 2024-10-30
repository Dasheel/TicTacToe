<?php

namespace App\Services\Contracts;

use App\Models\Game;

interface GameService
{
    public function startNewGame(): Game;

    public function makeMove(Game $game, int $position, int $playerId): Game;
}
