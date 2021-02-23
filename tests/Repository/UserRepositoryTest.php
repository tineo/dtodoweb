<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
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

    public function testGetAllUsers()
    {
        $users = $this->entityManager
            ->getRepository(User::class)
            ->findAll()
        ;

        $this->assertGreaterThanOrEqual(0, sizeof($users));
    }
    public function testupgradePassword()
    {
        $repo = $this->entityManager
            ->getRepository(User::class)
        ;

        $user = $repo->findOneBy(['email' => 'test@example.org']);
        $repo->upgradePassword($user, "notestpass");

        $this->assertNotEquals("testpass", $user->getPassword());
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
