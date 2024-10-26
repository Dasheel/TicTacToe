<?php

namespace App\Managers\Contracts;

interface WinnerManager
{
    public function hasWinner(array $grid): bool;
}
