<?php

namespace App\DTOs;

class PropertyAddressData
{
    public function __construct(
        public readonly string $country,
        public readonly string $state,
        public readonly string $city,
        public readonly string $street,
        public readonly string $zip,
        public readonly ?string $unitNumber = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            country: $data['country'],
            state: $data['state'],
            city: $data['city'],
            street: $data['street'],
            zip: $data['zip'],
            unitNumber: $data['unit_number'] ?? null
        );
    }
}
