<?php

namespace App\Repository;

use App\Entity\CompteDivisionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteDivisionnaire>
 *
 * @method CompteDivisionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteDivisionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteDivisionnaire[]    findAll()
 * @method CompteDivisionnaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteDivisionnaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteDivisionnaire::class);
    }

    public function add(CompteDivisionnaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompteDivisionnaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CompteDivisionnaire[] Returns an array of CompteDivisionnaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompteDivisionnaire
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
