<?php

namespace App\Services;

class GeocodingService implements GeocodingServiceInterface
{
    private string $baseUrl = 'https://nominatim.openstreetmap.org/search?format=json&limit=1&q=';

    public function geocodeAddress(string $address): ?array
    {
        $url = $this->baseUrl . urlencode($address);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (empty($data)) {
            return null;
        }

        return [
            'latitude' => $data[0]['lat'],
            'longitude' => $data[0]['lon'],
        ];
    }
}
