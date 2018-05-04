<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Job;


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
        return $this->createQueryBuilder('j')
            ->where('j.expiresAt > :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('j.expiresAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
