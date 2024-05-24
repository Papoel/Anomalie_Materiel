<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\OT;
use App\Entity\TOT;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OtFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 25; $i++) {
            $ot = new OT();
            $ot->setNumber(number: $faker->regexify(regex: '/\d{8}/'));
            $ot->setLibelle(libelle: $faker->text($faker->numberBetween(int1: 20, int2: 100)));
            $projets = ['0C2321', '1C2321', '2C2222'];
            $ot->setProjet(projet: $projets[array_rand($projets)]);
            $ot->setInstruction(instruction:
                $faker->boolean(25) ? null : $faker->text($faker->numberBetween(int1: 50, int2: 1000))
            );

            $manager->persist($ot);

            for ($j = 1; $j <= $faker->numberBetween(1, 5); $j++) {
                $tot = new TOT();
                $tot->setNumber($faker->numberBetween(1, 100));
                $tot->setLibelle($faker->text($faker->numberBetween(20, 100)));
                $tot->setOT($ot);
                $manager->persist($tot);
            }
        }

        $manager->flush();
    }
}
