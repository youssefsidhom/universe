<?php

namespace App\Repository;

use App\Entity\ProgMuscul;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgMuscul|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgMuscul|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgMuscul[]    findAll()
 * @method ProgMuscul[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgMusculRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgMuscul::class);
    }

    // /**
    //  * @return ProgMuscul[] Returns an array of ProgMuscul objects
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
    public function findOneBySomeField($value): ?ProgMuscul
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
