<?php

namespace App\Services;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class ViewShareService
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function categories()
    {
        return $this->em->getRepository(Category::class)->findAll();
    }
}