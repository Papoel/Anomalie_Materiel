<?php

namespace App\Controller;

use App\Service\GeoLocationService;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly GeoLocationService $geoLocationService,
        private readonly WeatherService $weatherService
    ) { }

    #[Route('/', name: 'home_index')]
    public function index(): Response
    {
        $city = $this->geoLocationService->getCityByIp();
        $weather = $this->weatherService->getWeatherByCity();

        return $this->render(view: 'home/index.html.twig',
            parameters: [
                'city'      => $city,
                'weather'   => $weather
                ]

        );
    }
}
