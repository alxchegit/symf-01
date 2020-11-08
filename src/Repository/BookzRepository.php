<?php

namespace App\Repository;

use App\Entity\Bookz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bookz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookz[]    findAll()
 * @method Bookz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookz::class);
    }

    // /**
    //  * @return Bookz[] Returns an array of Bookz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bookz
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
