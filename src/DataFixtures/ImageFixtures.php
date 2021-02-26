<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    const LOGO_REFERENCE = 'logo_ref';

    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setAlt("test alt");
        $image->setWidth(300);
        $image->setHeight(400);
        $image->setSize(1024);
        $image->setSrc("test/test.jpg");
        $image->setUser($this->getReference(UserFixtures::USER_REFERENCE));

        $manager->persist($image);
        $manager->flush();

        $this->addReference(self::LOGO_REFERENCE, $image);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
