<?php

namespace App\Repository;

use App\Entity\Ubigeo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ubigeo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ubigeo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ubigeo[]    findAll()
 * @method Ubigeo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UbigeoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ubigeo::class);
    }

}
