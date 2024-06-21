<?php

namespace App\Form\Type;

use App\Entity\User;
use App\EventSubscriber\UserTypeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(child: 'firstname', type: TextType::class, options: [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
                'required' => false,
            ])
            ->add(child: 'lastname', type: TextType::class, options: [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom',
                ],
                'required' => false,
            ])
            ->add(child: 'nni', type: TextType::class, options: [
                'label' => false,
                'attr' => [
                    'placeholder' => 'NNI',
                ],
                'required' => false,
            ])
            ->add(child: 'roles', type: CollectionType::class, options: [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'label' => false,
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                        'Chargé d\'affaires' => 'ROLE_CHARGE_AFFAIRES',
                        'Méthode' => 'ROLE_METHODE',
                        'Administrateur' => 'ROLE_ADMIN',
                    ],
                ],
                'label' => false,
                'required' => false,
            ])
            ->add(child: 'password', type: RepeatedType::class, options: [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => [
                    'toggle' => true,
                    'hidden_label' => 'Masquer',
                    'visible_label' => 'Afficher',
                    'button_classes' => ['btn', 'btn-sm'],
                    'toggle_container_classes' => ['input-group-text'],
                    'label' => false,
                    'always_empty' => false, // Permet de ne pas afficher le champ 'Mot de passe' si le champ 'Mot de passe' est vide
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'border-0 border-end border-blue rounded-3 border-3',
                    ],
                    'required' => false,
                ],
                'second_options' => [
                    'toggle' => true,
                    'hidden_label' => 'Masquer',
                    'visible_label' => 'Afficher',
                    'button_classes' => ['btn', 'btn-sm'],
                    'toggle_container_classes' => ['input-group-text'],
                    'label' => false,
                    'always_empty' => false, // Permet de ne pas afficher le champ 'Répéter le mot de passe' si le champ 'Mot de passe' est vide
                    'attr' => [
                        'placeholder' => 'Répéter le mot de passe',
                        'class' => 'border-0 border-end border-blue rounded-3 border-3',
                    ],
                    'required' => false,
                ],
            ])
            ->add(child: 'email', type: EmailType::class, options: [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                ],
                'required' => false,
            ])
            ->add(child: 'submit', type: SubmitType::class, options: [
                'label' => 'Créer un compte',
            ])
            ->addEventSubscriber(subscriber: new UserTypeSubscriber())
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['novalidate' => 'novalidate', 'html5' => false],
        ]);
    }
}
