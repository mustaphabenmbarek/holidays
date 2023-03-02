<?php

namespace App\DataFixtures;

use App\Entity\Accommodation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccommodationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //public const ACCOMMODATION_SUB_ACCOMMODATION = 'ACCOMMODATION_SUB_ACCOMMODATION';
        $accommodation = new Accommodation();
        $accommodation->setTitle('My Accommodation');
        $accommodation->setSlug('testslug');
        $accommodation->setDescription('testdescription');
        $accommodation->setNbrMaxPerson(3);
        $accommodation->setNightPrice(20.10);

        $manager->persist($accommodation);
        //$this->addReference(self::ACCOMMODATION_SUB_ACCOMMODATION, $accommodation);

        $manager->flush();
    }
}
