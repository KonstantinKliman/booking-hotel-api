<?php

namespace App\Exceptions\User;

use Exception;

class InvalidEmailVerificationTokenException extends Exception
{
    protected $message = 'Invalid token';
}
