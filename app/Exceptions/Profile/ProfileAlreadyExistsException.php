<?php

namespace App\Exceptions\Profile;

use App\Models\Profile;
use Exception;

class ProfileAlreadyExistsException extends Exception
{
    protected $message = 'Profile already exists';

    private Profile $profile;

    public function __construct(Profile $profile)
    {
        parent::__construct();
        $this->profile = $profile;
    }

    public function getProfile()
    {
        return [
            'id' => $this->profile->id,
            'firstName' => $this->profile->first_name,
            'lastName' => $this->profile->last_name,
            'phone' => $this->profile->phone,
            'dob' => $this->profile->dob->format('d-m-Y'),
            'accountType' => $this->profile->account_type,
            'country' => $this->profile->country,
            'city' => $this->profile->city,
            'fullAddress' => $this->profile->full_address
        ];
    }
}
