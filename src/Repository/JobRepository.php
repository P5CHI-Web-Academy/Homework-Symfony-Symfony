<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Job;
use App\Entity\Category;


class JobRepository extends ServiceEntityRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @return Job[]
     */
    public function findActiveJobs()
    {
        $qb = $this->createQueryBuilder('j');

        $this->applyActiveJobCondition($qb);

        return $qb->orderBy('j.expiresAt', 'DESC')
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
        $qb = $this->createQueryBuilder('j')
            ->where('j.id = :job_id')
            ->setParameter('job_id', $id);

        $this->applyActiveJobCondition($qb);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param Category $category
     * @return AbstractQuery
     */
    public function getActiveJobsByCategoryQuery(Category $category): AbstractQuery
    {
        $qb = $this->createQueryBuilder('j')
            ->where('j.category = :category')
            ->setParameter('category', $category);

        $this->applyActiveJobCondition($qb);

        return $qb->orderBy('j.expiresAt', 'DESC')->getQuery();
    }

    /**
     * @param QueryBuilder $builder
     */
    protected function applyActiveJobCondition(QueryBuilder $builder): void
    {
        $builder
            ->andWhere('j.expiresAt > :date')
            ->andWhere('j.activated = :activated')
            ->setParameter('date', new \DateTime())
            ->setParameter('activated', true);
    }
}
