<?php


namespace App\Exceptions;


use Flugg\Responder\Exceptions\Http\HttpException;

class TooManyAttemptsException extends HttpException
{
    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $status = 429;

    /**
     * The error code.
     *
     * @var string|null
     */
    protected $errorCode = 'too_many_attempts';

    /**
     * The error message.
     *
     * @var string|null
     */
    protected $message = 'You make too many requests.';
}
