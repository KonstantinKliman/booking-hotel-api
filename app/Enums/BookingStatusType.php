<?php

namespace App\Enums;

enum BookingStatusType: int
{
    case Pending = 1;

    case Confirmed = 2;

    case Cancelled = 3;

    case Completed = 4;
}
