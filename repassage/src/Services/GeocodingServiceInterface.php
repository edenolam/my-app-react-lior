<?php

namespace App\Services;

interface GeocodingServiceInterface
{
    public function geocodeAddress(string $address): ?array;
}
