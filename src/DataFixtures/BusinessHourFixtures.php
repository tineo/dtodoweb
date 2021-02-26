<?php

namespace App\DataFixtures;

use App\Entity\BusinessHours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BusinessHourFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bizHours = new BusinessHours();
        $dt = new \DateTime();
        $bizHours->setOpenTime($dt->setTime(14, 55));
        $bizHours->setCloseTime($dt->setTime(16, 55));
        $bizHours->setDay(0);

        $bizHours->setBusiness($this->getReference(BusinessFixtures::BUSINESS_REFERENCE));

        $manager->persist($bizHours);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BusinessFixtures::class,
        ];
    }
}
