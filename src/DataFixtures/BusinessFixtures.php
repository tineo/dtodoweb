<?php

namespace App\DataFixtures;

use App\Entity\Business;
use App\Entity\Ubigeo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BusinessFixtures extends Fixture implements DependentFixtureInterface
{
    const BUSINESS_REFERENCE = 'business_ref';

    public function load(ObjectManager $manager)
    {
        $biz = new Business();
        $biz->setName("test");
        $biz->setAddress("test address");
        $biz->setLat(30.00);
        $biz->setLng(40.00);

        $biz->setLogo($this->getReference(ImageFixtures::LOGO_REFERENCE));
        $biz->setUbigeo($this->getReference(UbigeoFixtures::UBIGEO_REFERENCE));
        $biz->addCategory($this->getReference(CategoryFixture::CATEGORY_REFERENCE));

        $manager->persist($biz);
        $manager->flush();

        $this->addReference(self::BUSINESS_REFERENCE, $biz);
    }

    public function getDependencies()
    {
        return [
            UbigeoFixtures::class,
            ImageFixtures::class,
            CategoryFixture::class,
        ];
    }
}
