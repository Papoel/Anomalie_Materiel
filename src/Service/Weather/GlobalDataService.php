<?php

namespace App\Service\Weather;

class GlobalDataService
{
    /** @var array<string, mixed> */
    private array $weatherData;

    public function __construct(
        private readonly WeatherService $weatherService
    ) {
        $weatherData = $this->weatherService->getWeatherByCity();
        // Je m'assure que $weatherData n'est pas null avant de l'assigner
        if (null !== $weatherData) {
            $this->weatherData = $weatherData;
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getWeatherData(): array
    {
        return $this->weatherData;
    }
}
