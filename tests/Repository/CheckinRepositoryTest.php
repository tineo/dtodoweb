<?php

namespace App\Tests\Repository;

use App\Entity\Checkin;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckinRepositoryTest extends KernelTestCase
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

    public function testGetAllCheckins()
    {
        $checkins = $this->entityManager
            ->getRepository(Checkin::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($checkins));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
