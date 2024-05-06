<?php

namespace App\Enums;

enum PaymentStatusType: int
{
    case Pending = 1;

    case Paid = 2;

    case Failed = 3;
}
