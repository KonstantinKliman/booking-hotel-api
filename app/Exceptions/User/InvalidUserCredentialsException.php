<?php

namespace App\Exceptions\User;

use Exception;

class InvalidUserCredentialsException extends Exception
{
    protected $message = 'Incorrect credentials';
}
