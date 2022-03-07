<?php

namespace App\Repository;

use App\Entity\Sportif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sportif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sportif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sportif[]    findAll()
 * @method Sportif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sportif::class);
    }

    // /**
    //  * @return Sportif[] Returns an array of Sportif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sportif
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
