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
        //$accommodationImage->setBooking($this->getReference(BookingFixtures::BOOKING_V));
        $manager->persist($accommodationImage);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BookingFixtures::class,
        ];
    }
}
