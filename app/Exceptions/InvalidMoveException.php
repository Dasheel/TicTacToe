<?php

namespace App\Exceptions;

class InvalidMoveException extends \Exception
{
    protected $message = 'The move is invalid.';
}
