<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_NNI', fields: ['nni'])]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Stringable
{
    use Traits\TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    private ?Ulid $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2, max: 50,
        minMessage: 'Le prénom doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le prénom doit contenir au maximum {{ limit }} caractères.'
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'Le prénom ne doit contenir que des lettres.'
    )]
    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $firstname = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2, max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères.'
    )]
    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $lastname = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 6, max: 6,
        minMessage: 'Le NNI doit contenir {{ limit }} caractères.',
        maxMessage: 'Le NNI doit contenir {{ limit }} caractères.'
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z][0-9]{5}$/',
        message: 'Le NNI doit commencer par une lettre suivie de 5 chiffres.'
    )]
    #[ORM\Column(type: Types::STRING, length: 6, unique: true)]
    private ?string $nni = null;

    /**
     * @var string[]
     */
    #[Assert\NotBlank]
    #[Assert\Count(min: 1)]
    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.')]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        message: 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.'
    )]
    #[Assert\NotCompromisedPassword]
    #[ORM\Column(type: Types::STRING)]
    private string $password;

    #[Assert\Email]
    #[Assert\NotBlank]
    #[Assert\Length(max: 180, maxMessage: 'L\'adresse email doit contenir au maximum {{ limit }} caractères.')]
    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    private ?string $email = null;

    public function __toString(): string
    {
        return $this->getFirstName().' '.$this->getLastName().' ('.$this->getNni().')';
    }

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNni(): ?string
    {
        return $this->nni;
    }

    public function setNni(string $nni): static
    {
        $this->nni = $nni;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->nni;
    }

    /**
     * @return array|string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
}
