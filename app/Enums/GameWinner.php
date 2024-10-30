<?php

namespace App\Enums;

use App\Models\Game;

enum GameWinner: string
{
    case PLAYER_1 = 'Player 1';
    case PLAYER_2 = 'Player 2';
    case DRAW = 'Draw';

    public static function fromGame(Game $game): self
    {
        return $game->player_id === 1 ? self::PLAYER_1 : self::PLAYER_2;
    }
}
