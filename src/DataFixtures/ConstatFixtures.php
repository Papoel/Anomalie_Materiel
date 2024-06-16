<?php

namespace App\DataFixtures;

use App\Entity\Constat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ConstatFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $constat = new Constat();
            $constat->setReference($faker->unique()->word);
            $tr = ['0', '1', '2', '9'];
            $se = ['ABP', 'AHP', 'ARE', 'CVI', 'DVN', 'EAS', 'LHP', 'LHQ', 'LHU', 'RCV', 'TEU', 'TEP', 'TEG', 'SAR', 'SAT', 'LLP'];
            $number = $faker->numberBetween(int1: 001, int2: 999);
            $type = ['DS', 'PO', 'RE', 'BA', 'CH', 'DI', 'TY'];
            $functional_marker = $tr[array_rand($tr)].$se[array_rand($se)].$number.$type[array_rand($type)];
            $constat->setFunctionalMarker($functional_marker);
            $constat->setEquipmentLabel($faker->word);
            $constat->setDescription($faker->paragraph);
            $constat->setProposedSolutions($faker->paragraph);
            $date_detection = $faker->dateTimeThisYear;
            $immutable_detection = \DateTimeImmutable::createFromMutable($date_detection);
            $constat->setDetectionDate($immutable_detection);
            $constat->setWriter($faker->name);
            $constat->setEdfControlName($faker->name);
            $date_edf_control = $faker->dateTimeThisYear;
            $immutable_edf_control = \DateTimeImmutable::createFromMutable($date_edf_control);
            $constat->setEdfControlDate($immutable_edf_control);
            $constat->setAnalysis($faker->paragraph);
            $constat->setPotentialImpacts($faker->paragraph);
            $constat->setRetainedSolutions($faker->paragraph);
            $constat->setSn3Name($faker->name);
            $date_sn3 = $faker->dateTimeThisYear;
            $immutable_sn3 = \DateTimeImmutable::createFromMutable($date_sn3);
            $constat->setSn3Date($immutable_sn3);
            $date_transmission = $faker->dateTimeThisYear;
            $immutable_transmission = \DateTimeImmutable::createFromMutable($date_transmission);
            $constat->setTransmissionDate($immutable_transmission);
            $constat->setTransmittedMethod($faker->boolean());
            $constat->setValidation($faker->word);
            $constat->setDtTotNumber($faker->regexify('[A-Z0-9]{10}'));
            $constat->setPaCstaNumber($faker->regexify('[A-Z0-9]{10}'));
            $constat->setValidationResponsable($faker->name);
            $date_validation = $faker->dateTimeThisYear;
            $immutable_validation = \DateTimeImmutable::createFromMutable($date_validation);
            $constat->setValidationDate($immutable_validation);
            $constat->setObservations($faker->paragraph);
            $constat->setImplementationResponsable($faker->name);
            $date_implementation = $faker->dateTimeThisYear;
            $immutable_implementation = \DateTimeImmutable::createFromMutable($date_implementation);
            $constat->setImplementationDate($immutable_implementation);
            $constat->setMethodAnalysisConfirmation($faker->paragraph);
            $constat->setMethodImpactProtectionInterests($faker->paragraph);
            $constat->setMethodRetainedSolutions($faker->paragraph);
            $date_created_at = $faker->dateTimeBetween($startDate = '-8 years', $endDate = 'now');
            $immutable = \DateTimeImmutable::createFromMutable($date_created_at);
            $constat->setCreatedAtValue($immutable);
            $date_updated_at = $immutable->modify(modifier: '+'.$faker->numberBetween(int1: 0, int2: 8).' years');
            $constat->setUpdatedAtValue($date_updated_at);

            $manager->persist($constat);
        }

        $manager->flush();
    }
}
