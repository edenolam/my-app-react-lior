<?php

namespace App\Repositories;

use mysqli;

class ServiceRepository
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function addService($name, $email, $address, $type, $latitude, $longitude): void
    {
        $stmt = $this->conn->prepare("INSERT INTO services (name, email, address, type, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $address, $type, $latitude, $longitude);
        $stmt->execute();
        $stmt->close();
    }

    public function findMatchingOffers($latitude, $longitude): array
    {
        $stmt = $this->conn->prepare("SELECT name, email, address FROM services WHERE type = 'offer' AND latitude = ? AND longitude = ?");
        $stmt->bind_param("ss", $latitude, $longitude);
        $stmt->execute();
        $result = $stmt->get_result();
        $matches = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $matches;
    }

    public function findMatchingDemands($latitude, $longitude): array
    {
        $stmt = $this->conn->prepare("SELECT name, email, address FROM services WHERE type = 'demand' AND latitude = ? AND longitude = ?");
        $stmt->bind_param("ss", $latitude, $longitude);
        $stmt->execute();
        $result = $stmt->get_result();
        $matches = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $matches;
    }
}
