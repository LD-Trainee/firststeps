<?php

namespace App\Repository;

use App\Entity\HerrchenEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HerrchenEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method HerrchenEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method HerrchenEntity[]    findAll()
 * @method HerrchenEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HerrchenEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HerrchenEntity::class);
    }

    // /**
    //  * @return HerrchenEntity[] Returns an array of HerrchenEntity objects
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
    public function findOneBySomeField($value): ?HerrchenEntity
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
