<?php

namespace App\Repository\Communication;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Communication\NewsLetterUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<NewsLetterUser>
 *
 * @method NewsLetterUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsLetterUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsLetterUser[]    findAll()
 * @method NewsLetterUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsLetterUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsLetterUser::class);
    }

    public function add(NewsLetterUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NewsLetterUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NewsLetterUser[] Returns an array of NewsLetterUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NewsLetterUser
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
