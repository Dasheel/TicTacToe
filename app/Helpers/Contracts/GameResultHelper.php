<?php

namespace App\Helpers\Contracts;

use App\Models\Game;
use App\Enums\GameWinner;

interface GameResultHelper
{
    public function determineWinner(Game $game, array $grid): ?GameWinner;
}
