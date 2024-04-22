<?php

namespace App\Enums;

enum AccountType: string
{
    case Owner = 'owner';

    case Customer = 'customer';
}
