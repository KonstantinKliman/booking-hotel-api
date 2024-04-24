<?php

namespace App\Exceptions\User;

use Exception;

class ExpiredEmailVerificationTokenException extends Exception
{
    protected $message = 'Token expired';
}
