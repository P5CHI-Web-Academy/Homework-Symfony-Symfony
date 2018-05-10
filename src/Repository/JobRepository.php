<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    /**
     * JobRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @param int $limit
     * @return array
     */
    public function findActive(int $limit = 20): array
    {
        $qb = $this->getActiveJobQuery()
            ->setMaxResults($limit);

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return Job|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findActiveJob(int $id): ?Job
    {
        $qb = $this->getActiveJobQuery()
            ->andWhere('j.id = :jobId')
            ->setParameter('jobId', $id);

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Category $category
     * @param int $maxPerPage
     * @return Pagerfanta
     */
    public function findActiveByCategoryPaginated(Category $category, int $maxPerPage = 10): Pagerfanta
    {
        $qb = $this->getActiveJobQuery();
        $qb
            ->andWhere('j.category = :category')
            ->setParameter('category', $category);

        $adapter = new DoctrineORMAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);
        $pagerFanta->setMaxPerPage($maxPerPage);

        return $pagerFanta;
    }

    /**
     * @return QueryBuilder
     */
    private function getActiveJobQuery(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('j');

        $qb
            ->where('j.expiresAt > :expireDate')
            ->andWhere('j.activated = :activated')
            ->setParameters([
                'expireDate' => new \DateTime(),
                'activated' => true,
            ]);

        return $qb;
    }
}
