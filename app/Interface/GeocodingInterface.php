<?php

declare(strict_types=1);
namespace App\Interface;

interface GeocodingInterface
{
    public function getCoordinates(string $address): array;
}
