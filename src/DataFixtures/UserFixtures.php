<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname('prenomuser');
        $user->setLastname('nameuser');
        $user->setEmail('user@user.com');
        $user->setPassword('$2y$13$79mYf7kUbRCKZpwgCzsF7.KN8Zr4I3VK63yOTscVOWBKem1zuUA2.');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
