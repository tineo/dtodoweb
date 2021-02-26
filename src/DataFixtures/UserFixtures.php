<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const USER_REFERENCE = 'user_ref';

    public function load(ObjectManager $manager)
    {
        $user= new User();
        $user->setEmail("test@example.org");
        $user->setPassword("testpass");

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_REFERENCE, $user);
    }
}
