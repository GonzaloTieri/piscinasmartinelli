<?php

namespace App\Repository;

use App\Entity\FotoGaleria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FotoGaleria|null find($id, $lockMode = null, $lockVersion = null)
 * @method FotoGaleria|null findOneBy(array $criteria, array $orderBy = null)
 * @method FotoGaleria[]    findAll()
 * @method FotoGaleria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FotoGaleriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FotoGaleria::class);
    }

    // /**
    //  * @return FotoGaleria[] Returns an array of FotoGaleria objects
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
    public function findOneBySomeField($value): ?FotoGaleria
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
