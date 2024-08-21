<?php

namespace App\Models;

class Service
{
    private int $id;
    private string $name;
    private string $email;
    private string $address;
    private string $type;
    private string $latitude;
    private string $longitude;
    private string $created_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->address = $data['address'];
        $this->type = $data['type'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->created_at = $data['created_at'] ?? null;
    }

    // Getters et setters pour chaque propriété

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}
