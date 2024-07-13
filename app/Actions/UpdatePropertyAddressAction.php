<?php

namespace App\Actions;

use App\DTOs\PropertyAddressData;
use App\Models\PropertyAddress;
use App\Services\GeocodeMapService;

class UpdatePropertyAddressAction
{
    public function __construct(private readonly GeocodeMapService $geocodingService)
    {
    }

    public function execute(PropertyAddressData $data, PropertyAddress $address): PropertyAddress
    {
        $fullAddress = "{$data->street} {$data->city} {$data->state} {$data->zip} {$data->country}";

        $coordinates = $this->geocodingService->getCoordinates($fullAddress);

        if (empty($coordinates)) {
            throw new \Exception('Unable to determine the latitude and longitude for the provided address.');
        }

        $address->update([
            'country' => $data->country,
            'state' => $data->state,
            'city' => $data->city,
            'street' => $data->street,
            'zip' => $data->zip,
            'unit_number' => $data->unitNumber,
            'latitude' => $coordinates['latitude'],
            'longitude' => $coordinates['longitude'],
        ]);
        return $address;
    }
}
