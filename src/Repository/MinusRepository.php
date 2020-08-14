<?php

namespace App\Repository;

use App\Entity\Minus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Minus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minus[]    findAll()
 * @method Minus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minus::class);
    }

    // /**
    //  * @return Minus[] Returns an array of Minus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Minus
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
