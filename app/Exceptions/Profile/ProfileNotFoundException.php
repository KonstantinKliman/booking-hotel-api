<?php

namespace App\Exceptions\Profile;

use Exception;

class ProfileNotFoundException extends Exception
{
    protected $message = 'Profile not found.';
}
