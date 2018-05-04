<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        $qb = $this->createQueryBuilder('j');

        $qb
            ->where('j.expiresAt > :expireDate')
            ->andWhere('j.activated = :activated')
            ->setParameters([
                'expireDate' => new \DateTime(),
                'activated' => true
            ])
            ->setMaxResults($limit);

        return $qb
            ->getQuery()
            ->getResult();
    }
}
