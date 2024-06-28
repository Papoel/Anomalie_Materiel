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
        $admin->setFirstname(firstname: 'Pascal');
        $admin->setLastname(lastname: 'Briffard');
        $admin->setNni(nni: 'F07583');
        $admin->setRoles(roles: ['ROLE_ADMIN']);
        $admin->setEmail(email: 'pascal.briffard@edf.fr');
        $hash = $this->passwordHasher->hashPassword(user: $admin, plainPassword: 'admin');
        $admin->setPassword(password: $hash);

        $manager->persist($admin);

        // Generate 5 users
        for ($i = 1; $i <= 5; ++$i) {
            $user = new User();
            // Random NNI : start with letter between A and Z and 5 digits
            $user->setFirstname(firstname: $faker->firstName());
            $user->setLastname(lastname: $faker->lastName());
            $user->setNni(nni: $faker->regexify(regex: '/[A-Z]\d{5}/'));
            $roles = ['ROLE_USER', 'ROLE_CHARGE_AFFAIRES', 'ROLE_METHODE'];
            $user->setRoles(roles: [$roles[array_rand($roles)]]);
            $user->setEmail(email: strtolower(string: $user->getFirstname()).'.'.strtolower(string: $user->getLastname()).'@edf.fr');
            $hash = $this->passwordHasher->hashPassword(user: $user, plainPassword: 'user');
            $user->setPassword(password: $hash);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
