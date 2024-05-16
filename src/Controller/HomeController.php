<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'home_index')]
    public function index(): Response
    {
        return $this->render(view: 'home/index.html.twig', parameters: [
            'controller_name' => 'HomeController',
        ]);
    }
}
