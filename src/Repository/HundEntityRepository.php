<?php

namespace App\Repository;

use App\Entity\HundEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HundEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method HundEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method HundEntity[]    findAll()
 * @method HundEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HundEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HundEntity::class);
    }

    // /**
    //  * @return HundEntity[] Returns an array of HundEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HundEntity
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
