<?php

namespace App\Enums;

/*
 * Одноместный номер (Single room)
 * Двухместный номер (Double room)
 * Номер с двумя отдельными кроватями (Twin room)
 * Люкс (Suite)
 * Стандартный номер (Standard room)
 * Семейный номер (Family room)
*/

enum RoomType: int
{
    case Single = 1;

    case Double = 2;

    case Twin = 3;

    case Suite = 4;

    case Standard = 5;

    case Family = 6;
}
