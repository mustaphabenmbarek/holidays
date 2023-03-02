<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //public const BOOKING_V = 'BOOKING_V';
        $booking = new Booking();
        $booking->setNbrPersons(2);
        $booking->setPrice(40.20);
        //$booking->setAccommodation($this->getReference(ccommodationFixtures::ACCOMMODATION_SUB_ACCOMMODATION));
        $manager->persist($booking);
        //$this->addReference(self::BOOKING_V, $booking);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AccommodationFixtures::class,
        ];
    }
}
