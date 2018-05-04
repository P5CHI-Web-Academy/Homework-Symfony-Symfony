<?php

namespace App\Repository;

use App\Entity\Job;
use \Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
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
                'activated' => true
            ])
            ->orderBy('j.expiresAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
