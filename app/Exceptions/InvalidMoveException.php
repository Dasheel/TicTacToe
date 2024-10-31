<?php

namespace App\Exceptions;

use App\Exceptions\Abstracts\HttpException;
use Symfony\Component\HttpFoundation\Response;

class InvalidMoveException extends HttpException
{
    public function __construct(
        $message = '',
        array $data = [],
        int $statusCode = Response::HTTP_BAD_REQUEST,
        ?\Throwable $previous = null,
        array $headers = [],
        int $code = 400
    ) {
        parent::__construct($message, $data, $statusCode, $previous, $headers, $code);
    }
}
