<?php

namespace App\Repository;

use App\Tests\Entity\PostRepositoryTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostRepositoryTest>
 *
 * @method PostRepositoryTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostRepositoryTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostRepositoryTest[]    findAll()
 * @method PostRepositoryTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepositoryTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostRepositoryTest::class);
    }

    public function add(PostRepositoryTest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PostRepositoryTest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PostRepositoryTest[] Returns an array of PostRepositoryTest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostRepositoryTest
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
