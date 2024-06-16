<?php

namespace App\Controller;

use App\Service\Weather\GeoLocationService;
use App\Service\Weather\GlobalDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly GeoLocationService $geoLocationService,
        private readonly GlobalDataService $globalDataService
    ) {
    }

    #[Route('/', name: 'home_index', methods: [Request::METHOD_GET])]
    public function index(): Response
    {
        $cityData = $this->geoLocationService->getCityByIp();

        $weatherData = $this->globalDataService->getWeatherData();

        return $this->render(view: 'home/index.html.twig', parameters: [
            'city' => $cityData,
            'weather' => $weatherData,
        ]);
    }
}
