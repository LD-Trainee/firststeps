<?php

namespace App\Repository;

use App\Entity\Zitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zitat[]    findAll()
 * @method Zitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZitatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zitat::class);
    }

    // /**
    //  * @return Zitat[] Returns an array of Zitat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zitat
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
