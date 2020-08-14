<?php

namespace App\Repository;

use App\Entity\Rechner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rechner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rechner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rechner[]    findAll()
 * @method Rechner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rechner::class);
    }

    // /**
    //  * @return Rechner[] Returns an array of Rechner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rechner
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
