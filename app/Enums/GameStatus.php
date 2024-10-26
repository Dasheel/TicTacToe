<?php

namespace App\Enums;

enum GameStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function isInProgress(): bool
    {
        return $this === self::IN_PROGRESS;
    }

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }
}
