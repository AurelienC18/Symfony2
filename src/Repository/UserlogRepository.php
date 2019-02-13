<?php

namespace App\Repository;

use App\Entity\Userlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Userlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Userlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Userlog[]    findAll()
 * @method Userlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserlogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Userlog::class);
    }

    // /**
    //  * @return Userlog[] Returns an array of Userlog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Userlog
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
