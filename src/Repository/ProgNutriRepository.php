<?php

namespace App\Repository;

use App\Entity\ProgNutri;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgNutri|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgNutri|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgNutri[]    findAll()
 * @method ProgNutri[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgNutriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgNutri::class);
    }

    // /**
    //  * @return ProgNutri[] Returns an array of ProgNutri objects
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
    public function findOneBySomeField($value): ?ProgNutri
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
