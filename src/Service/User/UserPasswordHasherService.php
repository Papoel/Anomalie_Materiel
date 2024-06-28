<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserPasswordHasherService
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function hashPassword(User $user, string $plainPassword): ?string
    {
        return $this->passwordHasher->hashPassword($user, $plainPassword);
    }
}
