<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\User;
use App\Form\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    public ?User $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $this->initialFormData ??= new User();
        // Rendre le nom.prenom dans email
        $this->initialFormData->setEmail($this->initialFormData->getFirstname() . '.' . $this->initialFormData->getLastname(). '@edf.fr');

        return $this->createForm(type: UserType::class, data: $this->initialFormData);
    }
    #[LiveAction]
    public function save(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
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

        // Hasher le mot de passe
        $hashedPassword = $passwordHasher->hashPassword($data, $data->getPassword());
        $data->setPassword($hashedPassword);

        $entityManager->persist($data);
        $entityManager->flush();

        // Si le formulaire est valide, on redirige vers la page d'accueil
        return $this->redirectToRoute(route: 'user_show', parameters: [
            'nni' => $data->getNni(),
        ]);
    }
}
