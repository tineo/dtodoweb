<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    const CATEGORY_REFERENCE = 'category_ref';

    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("test category");
        $category->setAlias("test");
        $category->setIcon("test.png");

        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $category);
    }
}
