<?php

namespace App\DataFixtures;

use App\Entity\AccommodationImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AccommodationImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $accommodationImage = new AccommodationImage();
        $accommodationImage->setPath('image1.png');
        $accommodationImage->setPosition(1);
        $accommodationImage->setAccommodation($this->getReference(accommodationFixtures::ACCOMMODATION_REF));
        $manager->persist($accommodationImage);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AccommodationFixtures::class,
        ];
    }
}
