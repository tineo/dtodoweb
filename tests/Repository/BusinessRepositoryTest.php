<?php

namespace App\Tests\Repository;

use App\Entity\Business;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BusinessRepositoryTest extends KernelTestCase
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

    public function testGetAllBusinessHours()
    {
        $business = $this->entityManager
            ->getRepository(Business::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($business));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
