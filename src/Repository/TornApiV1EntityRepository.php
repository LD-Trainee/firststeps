<?php

namespace App\Repository;

use App\Entity\TornApiV1Entity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TornApiV1Entity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TornApiV1Entity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TornApiV1Entity[]    findAll()
 * @method TornApiV1Entity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TornApiV1EntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TornApiV1Entity::class);
    }

    // /**
    //  * @return TornApiV1Entity[] Returns an array of TornApiV1Entity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TornApiV1Entity
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
