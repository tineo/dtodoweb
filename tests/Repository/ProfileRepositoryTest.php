<?php

namespace App\Tests\Repository;

use App\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProfileRepositoryTest extends KernelTestCase
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

    public function testGetAllProfiles()
    {
        $profiles = $this->entityManager
            ->getRepository(Profile::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($profiles));
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
