<?php

namespace App\Exceptions;

class InvalidPlayerException extends \Exception
{
    protected $message = 'It\'s not this player\'s turn';
}
