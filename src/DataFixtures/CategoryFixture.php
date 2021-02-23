<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $category = new Category();
         $category->setName("test category");
         $category->setAlias("test");
         $category->setIcon("test.png");

         $manager->persist($category);
         $manager->flush();
    }
}
