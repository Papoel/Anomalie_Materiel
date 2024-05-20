<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class WeatherService
{
    public function __construct(
        private HttpClientInterface   $httpClient,
        private GeoLocationService    $geoLocationService,
        private ParameterBagInterface $params
    ) {
    }

    public function getWeatherByCity(): ?array
    {
        $weather = [];

        $url = 'https://api.openweathermap.org/data/2.5/weather?q=';
        $city = strtolower($this->geoLocationService->getCityByIp()['name']);
        $apiKey = $this->params->get('OPENWEATHERMAP_API_KEY');
        $unit = 'metric';
        $lang = 'fr';

        $composeUrl = $url . $city . '&appid=' . $apiKey . '&units=' . $unit . '&lang=' . $lang;

        $response = $this->httpClient->request(
            method: 'GET',
            url: $composeUrl
        );

        $content = $response->toArray();

        $weather['temperature'] = $content['main']['temp'];
        $weather['description'] = $content['weather'][0]['description'];
        $weather['icon'] = $content['weather'][0]['icon'];

        return $weather;

    }
}
