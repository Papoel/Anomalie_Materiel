<?php

declare(strict_types=1);

namespace App\Twig\Components;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Service\User\UserPasswordHasherService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;

#[AsLiveComponent]
final class UserForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public ?User $data = null;

    protected function instantiateForm(): FormInterface
    {
        $this->data ??= new User();

        return $this->createForm(type: UserType::class, data: $this->data);
    }

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager, UserPasswordHasherService $passwordHasher): Response
    {
        // Valider le formulaire
        $this->validate();

        // Si le formulaire est valide, on le soumet
        $this->submitForm();

        // Vérifie si le formulaire n'est pas null avant d'appeler getData()
        if (null === $this->form) {
            throw new \RuntimeException(message: 'Le formulaire n\'a pas été initialisé.');
        }

        /** @var User $data */
        $data = $this->form->getData();

        $plainPassword = $data->getPassword();
        if ('' !== $plainPassword) {
            $hashedPassword = $passwordHasher->hashPassword($data, $plainPassword);
            if (null !== $hashedPassword) {
                $data->setPassword($hashedPassword);
            }
        }

        $entityManager->persist($data);

        // Before the flush, we need verify if the NNI is unique in the database
        $nni = $data->getNni();

        if ($entityManager->getRepository(User::class)->findOneBy(['nni' => $nni])) {
            $this->addFlash(type: 'danger', message: "Désolé, le NNI \"$nni\" est déjà attribué à un autre utilisateur.");

            return $this->redirectToRoute(route: 'home_index');
        }

        if ($entityManager->getRepository(User::class)->findOneBy(['email' => $data->getEmail()])) {
            $this->addFlash(type: 'danger', message: "Désolé, l'adresse email \"{$data->getEmail()}\" est déjà attribuée à un autre utilisateur.");

            return $this->redirectToRoute(route: 'home_index');
        }

        $entityManager->flush();
        $firstName = $data->getFirstname();
        $lastName = $data->getLastname();

        $this->addFlash(type: 'success', message: "L'utilisateur \"$firstName $lastName\" a été créé avec succès.");

        // Si le formulaire est valide, on redirige vers la page de l'utilisateur créé
        return $this->redirectToRoute(route: 'user_show', parameters: [
            'id' => $data->getId(),
        ]);
    }
}
