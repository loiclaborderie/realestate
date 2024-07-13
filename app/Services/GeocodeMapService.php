<?php

namespace App\Services;

use App\Interface\GeocodingInterface;
use Illuminate\Support\Facades\Http;

class GeocodeMapService implements GeocodingInterface
{
    protected mixed $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.geocode_maps.api_key');
    }
    public function getCoordinates(string $address): array
    {
        $address = urlencode($address);
        $url = 'https://geocode.maps.co/search?q='. $address .'&api_key='.$this->apiKey;
        $response = Http::get($url);
        if ($response->successful() && !empty($response->json())) {
            $location = $response->json()[0];
            return [
                'latitude' => $location['lat'],
                'longitude' => $location['lon'],
            ];
        } else {
            return [];
        }
    }
}
