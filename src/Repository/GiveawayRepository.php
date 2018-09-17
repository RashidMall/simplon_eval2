<?php

namespace App\Repository;

use App\Entity\Giveaway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Giveaway|null find($id, $lockMode = null, $lockVersion = null)
 * @method Giveaway|null findOneBy(array $criteria, array $orderBy = null)
 * @method Giveaway[]    findAll()
 * @method Giveaway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiveawayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Giveaway::class);
    }

//    /**
//     * @return Giveaway[] Returns an array of Giveaway objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Giveaway
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
