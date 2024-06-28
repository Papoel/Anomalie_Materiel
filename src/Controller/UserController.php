<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index', methods: [Request::METHOD_GET])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render(view: 'user/index.html.twig', parameters: [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: [Request::METHOD_GET])]
    public function show(User $user): Response
    {
        return $this->render(view: 'user/show.html.twig', parameters: [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(type: UserType::class, data: $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(route: 'user_index', status: Response::HTTP_SEE_OTHER);
        }

        return $this->render(view: 'user/edit.html.twig', parameters: [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: [Request::METHOD_POST])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid(id: 'delete'.$user->getId(), token: $request->getPayload()->getString(key: '_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute(route: 'user_index', status: Response::HTTP_SEE_OTHER);
    }
}
