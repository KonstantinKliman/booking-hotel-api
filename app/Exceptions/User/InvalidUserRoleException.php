<?php

namespace App\Exceptions\User;

use Exception;

class InvalidUserRoleException extends Exception
{
    protected $message = 'User haven`t permissions to this action';
}
