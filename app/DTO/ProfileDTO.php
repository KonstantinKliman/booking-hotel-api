<?php

namespace App\DTO;

class ProfileDTO
{
    public string $firstName;
    public string $lastName;
    public string $phone;
    public string $dob;
    public string $accountType;
    public string $country;
    public string $city;
    public string|null $fullAddress;

    public function __construct(string $firstName,
                                string $lastName,
                                string $phone,
                                string $dob,
                                string $accountType,
                                string $country,
                                string $city,
                                string|null $fullAddress)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->dob = $dob;
        $this->accountType = $accountType;
        $this->country = $country;
        $this->city = $city;
        $this->fullAddress = $fullAddress;
    }
}
