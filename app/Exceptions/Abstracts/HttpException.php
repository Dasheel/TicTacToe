<?php

namespace App\Exceptions\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as BaseHttpException;

/** @codeCoverageIgnore */
abstract class HttpException extends BaseHttpException
{
    public function __construct(
        protected $message = '',
        protected array $data = [],
        protected int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        ?\Throwable $previous = null,
        array $headers = [],
        int $code = 403
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->message,
            'code' => $this->code,
        ], $this->statusCode);
    }

    public function context(): array
    {
        return $this->data;
    }
}
