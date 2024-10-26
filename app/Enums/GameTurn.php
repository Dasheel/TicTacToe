<?php

namespace App\Enums;

enum GameTurn: string
{
    case X = 'X';
    case O = 'O';

    public function next(): GameTurn
    {
        return $this === self::X ? self::O : self::X;
    }
}
