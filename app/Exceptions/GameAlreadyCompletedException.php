<?php

namespace App\Exceptions;

class GameAlreadyCompletedException extends \Exception
{
    protected $message = 'Game is already completed.';
}
