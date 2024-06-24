<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Psr\Log\LoggerInterface;
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

        // Vérifie si un rôle a été sélectionné ou si ROLE_USER est déjà présent
        $roles = $data->getRoles();
        if (empty($roles)) {
            $data->setRoles(['ROLE_USER']);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => 'onFormSubmit',
        ];
    }
}
