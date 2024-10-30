<?php

namespace App\Helpers;

use App\Models\Game;
use App\Enums\GameWinner;
use App\Managers\Contracts\WinnerManager;
use App\Helpers\Contracts\GameResultHelper as GameResultHelperContract;

class GameResultHelper implements GameResultHelperContract
{
    public function __construct(private readonly WinnerManager $winnerManager) {}

    public function determineWinner(Game $game, array $grid): ?GameWinner
    {
        if ($this->winnerManager->hasWinner($grid)) {
            return GameWinner::fromGame($game);
        }

        if ($this->winnerManager->isDraw($grid)) {
            return GameWinner::DRAW;
        }

        return null;
    }
}
