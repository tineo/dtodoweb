<?php

namespace App\Tests\Repository;

use App\Entity\BusinessHours;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BusinessHoursRepositoryTest extends KernelTestCase
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
        $businessHours = $this->entityManager
            ->getRepository(BusinessHours::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($businessHours));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
