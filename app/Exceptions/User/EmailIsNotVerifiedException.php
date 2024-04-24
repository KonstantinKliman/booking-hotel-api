<?php

namespace App\Exceptions\User;

use Exception;

class EmailIsNotVerifiedException extends Exception
{
    protected $message = 'Email is not verified.';
}
