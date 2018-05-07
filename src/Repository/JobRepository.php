<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @return Job[]
     */
    public function findActiveJobs(): array
    {
        return $this->createQueryBuilder('j')
            ->where('j.expiresAt > :datetime')
            ->andWhere('j.activated = :activated')
            ->setParameters([
                'datetime' => new \DateTime(),
                'activated' => true,
            ])
            ->orderBy('j.expiresAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findActiveJob(int $id)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.id = :id')
            ->andWhere('j.expiresAt > :datetime')
            ->andWhere('j.activated = :activated')
            ->setParameters([
                'id' => $id,
                'datetime' => new \DateTime(),
                'activated' => true,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
