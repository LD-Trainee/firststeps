<?php

namespace App\Repository;

use App\Entity\NicApiViewEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NicApiViewEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method NicApiViewEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method NicApiViewEntity[]    findAll()
 * @method NicApiViewEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NicApiViewEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NicApiViewEntity::class);
    }

    // /**
    //  * @return NicApiViewEntity[] Returns an array of NicApiViewEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NicApiViewEntity
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
