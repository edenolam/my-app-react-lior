<?php

namespace App\Controllers;

use App\Repositories\ServiceRepository;
use App\Services\GeocodingServiceInterface;
use App\Services\EmailServiceInterface;
use Exception;

class ServiceController
{
    private ServiceRepository $repository;
    private GeocodingServiceInterface $geocodingService;
    private EmailServiceInterface $emailService;

    public function __construct(ServiceRepository $repository, GeocodingServiceInterface $geocodingService, EmailServiceInterface $emailService)
    {
        $this->repository = $repository;
        $this->geocodingService = $geocodingService;
        $this->emailService = $emailService;
    }

    /**
     * @throws Exception
     */
    public function handleFormSubmission(array $formData): void
    {
        $name = $formData['name'];
        $email = $formData['email'];
        $address = $formData['address'];
        $type = $formData['type'];

        // Obtenir les coordonnées géographiques
        $geocode = $this->geocodingService->geocodeAddress($address);

        if ($geocode === null) {
            throw new Exception('Impossible de géocoder l\'adresse.');
        }

        $latitude = $geocode['latitude'];
        $longitude = $geocode['longitude'];

        // Ajouter le service à la base de données
        $this->repository->addService($name, $email, $address, $type, $latitude, $longitude);

        // Trouver les services correspondants
        $matches = [];
        if ($type === 'demand') {
            $matches = $this->repository->findMatchingOffers($latitude, $longitude);
        } elseif ($type === 'offer') {
            $matches = $this->repository->findMatchingDemands($latitude, $longitude);
        }

        // Envoyer les emails de mise en contact
        foreach ($matches as $match) {
            if ($type === 'demand') {
                $this->emailService->sendEmail($email, 'Correspondance de Repassage', "Vous avez une nouvelle offre de repassage de {$match['name']}. Adresse : {$match['address']}.");
                $this->emailService->sendEmail($match['email'], 'Correspondance de Repassage', "Vous avez une nouvelle demande de repassage de {$name}. Adresse : {$address}.");
            } elseif ($type === 'offer') {
                $this->emailService->sendEmail($email, 'Correspondance de Repassage', "Vous avez une nouvelle demande de repassage de {$match['name']}. Adresse : {$match['address']}.");
                $this->emailService->sendEmail($match['email'], 'Correspondance de Repassage', "Vous avez une nouvelle offre de repassage de {$name}. Adresse : {$address}.");
            }
        }
    }
}
