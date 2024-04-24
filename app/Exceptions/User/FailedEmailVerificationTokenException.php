<?php

namespace App\Exceptions\User;

use Exception;

class FailedEmailVerificationTokenException extends Exception
{
    protected $message = 'Email verification failed. Please, try again later';
}
