<?php

namespace App\Tests\Repository;

use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImageRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetAllImages()
    {
        $images = $this->entityManager
            ->getRepository(Image::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($images));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
