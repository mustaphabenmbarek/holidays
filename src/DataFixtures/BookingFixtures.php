<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $booking = new Booking();
        $booking->setTitle('Mon logement');
        $booking->setNbrPersons(2);
        $booking->setPrice(40.20);
        $booking->setDepartureDate(\DateTime::createFromFormat('d/m/Y', '02/01/2022'));
        $booking->setArrivalDate(\DateTime::createFromFormat('d/m/Y', '12/01/2022'));
        $booking->setAccommodation($this->getReference(AccommodationFixtures::ACCOMMODATION_REF));
        $booking->setUser($this->getReference(UserFixtures::USER_REF));
        $manager->persist($booking);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AccommodationFixtures::class,
            UserFixtures::class,
        ];
    }
}
