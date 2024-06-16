<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class WeatherService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private GeoLocationService $geoLocationService,
        private ParameterBagInterface $params
    ) {
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getWeatherByCity(): ?array
    {
        $weather = [];

        $cityData = $this->geoLocationService->getCityByIp();
        if ($cityData === null || !isset($cityData['name'])) {
            return null;
        }

        $url = 'https://api.openweathermap.org/data/2.5/weather?q=';
        // $city = strtolower($this->geoLocationService->getCityByIp()['name']);
        $city = strtolower($cityData['name']);

        $apiKey = $this->params->get('OPENWEATHERMAP_API_KEY');
        // Vérifier que $apiKey est une chaîne
        if (!is_string($apiKey)) {
            return null;
        }

        $unit = 'metric';
        $lang = 'fr';

        // Vérification des valeurs avant la concaténation
        if ($apiKey === '') {
            return null;
        }

        $composeUrl = sprintf('%s%s&appid=%s&units=%s&lang=%s', $url, urlencode($city), $apiKey, $unit, $lang);

        try {
            $response = $this->httpClient->request(
                method: Request::METHOD_GET,
                url: $composeUrl
            );
            $content = $response->toArray();
        } catch (\Exception $e) {
            // Gérer les exceptions possibles lors de la requête HTTP
            return null;
        }

        // Vérification que les clés existent avant l'accès
        if (!isset($content['main']['temp'], $content['weather'][0]['description'], $content['weather'][0]['icon'])) {
            return null;
        }

        $weather['temperature'] = $content['main']['temp'] ?? null;
        $weather['description'] = $content['weather'][0]['description'] ?? null;
        $weather['icon'] = $content['weather'][0]['icon'] ?? null;

        return $weather;
    }
}
