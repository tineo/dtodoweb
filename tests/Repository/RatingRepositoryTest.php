<?php

namespace App\Tests\Repository;

use App\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RatingRepositoryTest extends KernelTestCase
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

    public function testGetAllRatings()
    {
        $ratings = $this->entityManager
            ->getRepository(Rating::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($ratings));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
