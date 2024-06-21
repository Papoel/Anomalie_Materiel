<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserTypeSubscriber implements EventSubscriberInterface
{
    public function onFormSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $entity = $event->getData();

        // Vérifie si l'entité est de type User
        if (!$entity instanceof User) {
            return;
        }

        // Vérifie si un rôle a été sélectionné ou si ROLE_USER est déjà présent
        if (null === $entity->getRoles() || in_array(needle: 'ROLE_USER', haystack: $entity->getRoles(), strict: true)) {
            $entity->setRoles(['ROLE_USER']);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => 'onFormSubmit',
        ];
    }
}
