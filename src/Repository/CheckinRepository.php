<?php

namespace App\Repository;

use App\Entity\Checkin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Checkin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Checkin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Checkin[]    findAll()
 * @method Checkin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckinRepository extends ServiceEntityRepository
{
    /**
     * CheckinRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Checkin::class);
    }
    public function register(Checkin $checkin){
        $this->_em->persist($checkin);


    }
}
