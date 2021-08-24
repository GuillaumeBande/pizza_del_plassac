<?php

namespace App\Repository;

use App\Entity\Artidle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Artidle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artidle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artidle[]    findAll()
 * @method Artidle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtidleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artidle::class);
    }

    // /**
    //  * @return Artidle[] Returns an array of Artidle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artidle
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
