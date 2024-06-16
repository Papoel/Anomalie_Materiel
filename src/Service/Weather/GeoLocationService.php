<?php

declare(strict_types=1);

namespace App\Service\Weather;

use GeoIp2\Database\Reader;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class GeoLocationService
{
    /**
     * @information: obtenir mon adresse IP: https://mon-adresse-ip.fr/
     * $city = $cityDbReader->city($this->requestStack->getCurrentRequest()->getClientIp());
     */
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    /**
     * @return array<string, string>|null
     */
    public function getCityByIp(): ?array
    {
        $cityInfos = [];

        try {
            $cityDbReader = new Reader(__DIR__.'/../../../src/Model/geolite_city.mmdb');
        } catch (InvalidDatabaseException $e) {
            // Afficher un message d'erreur indiquant que la base de données est invalide
            return null;
        }

        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return null;
        }

        $ipAddress = $request->getClientIp();
        if (null === $ipAddress) {
            return null;
        }

        try {
            // TODO: Supprimer le if en PROD
            if ('::1' === $ipAddress) { // '::1' est une notation pour l'adresse IP locale IPv6 (localhost)
                $ipAddress = '83.204.157.183'; // Adresse IP statique temporaire pour le développement
            }
            $city = $cityDbReader->city($ipAddress);
        } catch (\Exception $e) {
            // Gérer les exceptions possibles lors de la recherche de la ville
            return null;
        }

        // Vérifier que les champs ne sont pas null
        $cityName = $city->city->name ?? null;
        $departmentName = $city->subdivisions[1]->name ?? null;
        $countryName = $city->country->name ?? null;

        if (null === $cityName || null === $departmentName || null === $countryName) {
            return null;
        }

        return [
            'name' => $cityName,
            'department' => $departmentName,
            'country' => $countryName,
        ];
    }
}
