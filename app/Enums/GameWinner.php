<?php

namespace App\Enums;

enum GameWinner: string
{
    case X = 'X';
    case O = 'O';
    case Draw = 'draw';

    public static function fromTurn(GameTurn $turn): self
    {
        return $turn === GameTurn::X ? self::X : self::O;
    }
}
