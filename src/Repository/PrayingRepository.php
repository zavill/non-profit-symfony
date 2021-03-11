<?php

namespace App\Repository;

use App\Entity\Praying;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Praying|null find($id, $lockMode = null, $lockVersion = null)
 * @method Praying|null findOneBy(array $criteria, array $orderBy = null)
 * @method Praying[]    findAll()
 * @method Praying[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrayingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Praying::class);
    }

    // /**
    //  * @return Praying[] Returns an array of Praying objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Praying
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
