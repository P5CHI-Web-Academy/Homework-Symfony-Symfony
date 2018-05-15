<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @return Job[] Returns an array of Job objects
     */
    public function findActiveJobs()
    {
        return $this->createQueryBuilder('j')
            ->where('j.activated = :activated')
            ->andWhere('j.expiresAt > :date')
            ->setParameters([
                'activated' => true,
                'date' => new \DateTime(),
            ])
            ->orderBy('j.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return Job[] Returns an array of Job objects
     */
    public function findByCategory($id)
    {
        return $this->createQueryBuilder('j')
            ->select('j')
            ->where('j.category = :id')
            ->andWhere('j.activated = :activated')
            ->andWhere('j.expiresAt > :date')
            ->setParameters([
                'id' => $id,
                'activated' => true,
                'date' => new \DateTime(),
            ])
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOrNull($id)
    {
        return $this->createQueryBuilder('j')
            ->where('j.id = :id')
            ->andWhere('j.activated = :activated')
            ->andWhere('j.expiresAt > :date')
            ->setParameters([
                'id' => $id,
                'activated' => true,
                'date' => new \DateTime(),
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findPaginatedJobsByCategory(Category $category) : AbstractQuery
    {
        return $this->createQueryBuilder('j')
            ->where('j.category = :category')
            ->andWhere('j.activated = :activated')
            ->andWhere('j.expiresAt > :date')
            ->setParameters([
                'category' => $category,
                'activated' => true,
                'date' => new \DateTime(),
            ])
            ->getQuery();
    }
}
