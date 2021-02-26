<?php

namespace App\Tests\Repository;

use App\Entity\Business;
use App\Entity\Checkin;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

    public function testRegisterCheckin()
    {
        //$session = new Session(new MockFileSessionStorage());

        $biz = $this->entityManager
            ->getRepository(Business::class)
            ->findOneBy(['name' => 'test']);

        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@example.org']);

        $checkin = new Checkin();
        $checkin->setBusiness($biz);
        $checkin->setUser($user);

         $this->entityManager
            ->getRepository(Checkin::class)
            ->register($checkin)
        ;
         $this->entityManager->flush();

        $this->assertNotNull($checkin->getId());
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
