<?php

declare(strict_types=1);

namespace App\Enums;

enum PropertyType: string
{
case HOUSE = 'house';
case APARTMENT = 'apartment';
case BUILDING = 'building';
case OFFICE = 'office';
}

