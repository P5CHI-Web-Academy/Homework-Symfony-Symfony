<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findCategoriesWithActiveJobs()
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.jobs', 'j')
            ->andWhere('j.activated = :active')
            ->andWhere('j.expiresAt > :datetime')
            ->setParameters([
                'active' => true,
                'datetime' => new \DateTime(),
            ])
            ->addOrderBy('c.name', 'ASC')
            ->addOrderBy('j.expiresAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
