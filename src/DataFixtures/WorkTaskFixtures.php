<?php

namespace App\DataFixtures;

use App\Entity\WorkOrder;
use App\Entity\WorkTask;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WorkTaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');
        $workOrders = $manager->getRepository(className: WorkOrder::class)->findAll();

        for ($i = 0; $i < 30; ++$i) {
            $workTask = new WorkTask();
            $workTask->setTaskNumber(task_number: $faker->numberBetween(int1: 1, int2: 10));
            $workTask->setLibelle(libelle: $faker->text($faker->numberBetween(int1: 20, int2: 100)));
            $workTask->setInstruction(instruction: $faker->paragraph());
            $workTask->setWorkOrder(workOrder: $faker->randomElement($workOrders));
            $date_created_at = $faker->dateTimeBetween($startDate = '-8 years', $endDate = 'now');
            $immutable = \DateTimeImmutable::createFromMutable($date_created_at);
            $workTask->setCreatedAtValue($immutable);
            $date_updated_at = $immutable->modify(modifier: '+'.$faker->numberBetween(int1: 0, int2: 8).' years');
            $workTask->setUpdatedAtValue($date_updated_at);

            $manager->persist($workTask);
        }

        $manager->flush();
    }
}
