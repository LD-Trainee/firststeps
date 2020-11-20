<?php

namespace App\Repository;

use App\Entity\DeliciousPizzaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeliciousPizzaEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliciousPizzaEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliciousPizzaEntity[]    findAll()
 * @method DeliciousPizzaEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliciousPizzaEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliciousPizzaEntity::class);
    }

    // /**
    //  * @return DeliciousPizzaEntity[] Returns an array of DeliciousPizzaEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeliciousPizzaEntity
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
