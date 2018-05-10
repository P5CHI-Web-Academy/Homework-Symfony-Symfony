<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    /**
     * CategoryRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[]
     */
    public function findWithActiveJobs(): array
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c', 'j')
            ->innerJoin('c.jobs', 'j')
            ->where('j.expiresAt > :expireDate')
            ->andWhere('j.activated = :activated')
            ->setParameters([
                'expireDate' => new \DateTime(),
                'activated' => true,
            ]);

        return $qb
            ->getQuery()
            ->getResult();
    }
}
