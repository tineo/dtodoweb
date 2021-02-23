<?php

namespace App\Tests\Repository;

use App\Entity\Ubigeo;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UbigeoRepositoryTest extends KernelTestCase
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

    public function testGetAllUbigeos()
    {
        $ubigeos = $this->entityManager
            ->getRepository(Ubigeo::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($ubigeos));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
