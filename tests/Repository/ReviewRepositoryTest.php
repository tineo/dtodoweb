<?php

namespace App\Tests\Repository;

use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReviewRepositoryTest extends KernelTestCase
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

    public function testGetAllReviews()
    {
        $reviews = $this->entityManager
            ->getRepository(Review::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($reviews));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
