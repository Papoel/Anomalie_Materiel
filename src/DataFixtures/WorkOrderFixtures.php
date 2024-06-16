<?php

namespace App\DataFixtures;

use App\Entity\WorkOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WorkOrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $workOrder = new WorkOrder();

            $workOrder->setOrderNumber(order_number: $faker->regexify(regex: '/\d{8}/'));
            $workOrder->setLibelle(libelle: $faker->text($faker->numberBetween(int1: 20, int2: 100)));
            $projects = ['0C2321', '1C2321', '2C2222'];
            $workOrder->setProject($faker->randomElement($projects));
            $states = ['en_cours', 'terminé', 'attente_methode'];
            $workOrder->setState($faker->randomElement($states));
            $date_created_at = $faker->dateTimeBetween($startDate = '-8 years', $endDate = 'now');
            $immutable = \DateTimeImmutable::createFromMutable($date_created_at);
            $workOrder->setCreatedAtValue($immutable);
            $date_updated_at = $immutable->modify(modifier: '+'.$faker->numberBetween(int1: 0, int2: 8).' years');
            $workOrder->setUpdatedAtValue($date_updated_at);

            $manager->persist($workOrder);
        }

        $manager->flush();
    }
}
