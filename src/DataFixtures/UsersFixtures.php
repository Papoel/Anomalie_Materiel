<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $admin = new User();
        $admin->setNni(nni: 'F07583');
        $admin->setFirstname(firstname: 'Pascal');
        $admin->setLastname(lastname: 'Briffard');
        $admin->setRoles(roles: ['ROLE_ADMIN']);
        $hash = $this->passwordHasher->hashPassword(user: $admin, plainPassword: 'admin');
        $admin->setPassword(password: $hash);

        $manager->persist($admin);

        // Generate 150 users
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            // Random NNI : start with letter between A and Z and 5 digits
            $user->setNni(nni: $faker->regexify(regex: '/[A-Z]\d{5}/'));
            $user->setFirstname(firstname: $faker->firstName());
            $user->setLastname(lastname: $faker->lastName());
            $user->setRoles(roles: ['ROLE_USER']);
            $hash = $this->passwordHasher->hashPassword(user: $user, plainPassword: 'user');
            $user->setPassword(password: $hash);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
