<?php

namespace App\DataFixtures;

use App\Entity\Accommodation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccommodationFixtures extends Fixture
{
    public const ACCOMMODATION_REF = 'ACCOMMODATION_REF';
    
    public function load(ObjectManager $manager): void
    {
        $accommodation = new Accommodation();
        $accommodation->setTitle('Mon hébergement');
        $accommodation->setSlug('testslug');
        $accommodation->setDescription('testdescriptionxxxxxxxyyyyyyy');
        $accommodation->setNbrMaxPerson(3);
        $accommodation->setNightPrice(20.10);

        $manager->persist($accommodation);
        $this->addReference(self::ACCOMMODATION_REF, $accommodation);

        $manager->flush();
    }
}
