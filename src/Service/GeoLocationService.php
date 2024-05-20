<?php

declare(strict_types=1);

namespace App\Service;



use GeoIp2\Database\Reader;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class GeoLocationService
{
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    public function getCityByIp(): ?array
    {
        $cityInfos = [];
        $cityDbReader = new Reader(filename: __DIR__ . '/../../src/Model/geolite_city.mmdb');

        $city = $cityDbReader->city(ipAddress: '2a01:e0a:4ab:3e10:a989:74b5:8796:5dc1');

        /* TODO: Remplacer en PROD par :
         *  $city = $cityDbReader->city($this->requestStack->getCurrentRequest()->getClientIp());
         *  obtenir mon adresse IP: https://mon-adresse-ip.fr/
        */

        // Add $city->subdivisions[1]->name, $city->country->name in the array
        $cityInfos["name"] = $city->city->name;
        $cityInfos["department"] = $city->subdivisions[1]->name;
        $cityInfos["country"] = $city->country->name;

        return $cityInfos;
    }
}
