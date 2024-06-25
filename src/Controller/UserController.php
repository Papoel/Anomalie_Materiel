<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_show', methods: [Request::METHOD_GET])]
    public function show(?User $user): Response
    {
        if (!$user) {
            throw $this->createNotFoundException(message: 'Utilisateur non trouvé.');
        }

        return $this->render(view: 'user/index.html.twig', parameters: [
            'user' => $user,
        ]);
    }
}
