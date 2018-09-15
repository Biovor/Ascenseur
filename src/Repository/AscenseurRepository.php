<?php

namespace App\Repository;

use App\Entity\Ascenseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ascenseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ascenseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ascenseur[]    findAll()
 * @method Ascenseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AscenseurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ascenseur::class);
    }

//    /**
//     * @return Ascenseur[] Returns an array of Ascenseur objects
//     */
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
    public function findOneBySomeField($value): ?Ascenseur
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
