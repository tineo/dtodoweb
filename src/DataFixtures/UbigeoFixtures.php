<?php

namespace App\DataFixtures;

use App\Entity\Ubigeo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UbigeoFixtures extends Fixture
{
    public const UBIGEO_REFERENCE = 'ubigeo_ref';

    public function load(ObjectManager $manager)
    {
        $ubigeo = new Ubigeo();
        $ubigeo->setName("test ubigeo");
        $ubigeo->setAbbreviation("test");
        $ubigeo->setCode(123);
        $ubigeo->setLat(3.00);
        $ubigeo->setLng(4.00);
        $ubigeo->setType('P');

        $manager->persist($ubigeo);
        $manager->flush();

        $this->addReference(self::UBIGEO_REFERENCE, $ubigeo);

    }
}
