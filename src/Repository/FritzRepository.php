<?php

namespace App\Repository;

use App\Entity\Fritz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fritz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fritz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fritz[]    findAll()
 * @method Fritz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FritzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fritz::class);
    }

    // /**
    //  * @return Fritz[] Returns an array of Fritz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fritz
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
