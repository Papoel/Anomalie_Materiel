<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

readonly class UserTypeSubscriber implements EventSubscriberInterface
{
    public function onFormSubmit(FormEvent $event): void
    {
        $data = $event->getData();
        $form = $event->getForm();

        // Vérifie si l'entité est de type User
        if (!$data instanceof User) {
            return;
        }

        // Filtre les rôles pour éliminer les valeurs nulles ou vides
        $roles = array_filter($data->getRoles(), function ($role) {
            return null !== $role && '' !== $role;
        });

        // Vérifie si un rôle a été sélectionné ou si ROLE_USER est déjà présent
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        $data->setRoles($roles);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => 'onFormSubmit',
        ];
    }
}
