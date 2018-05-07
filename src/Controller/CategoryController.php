<?php

namespace App\Controller;

use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="category.")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="category_job_list")
     * @Method("GET")
     * @param Category $category
     * @return Response
     */
    public function showJobList(Category $category): Response
    {
        return $this->render('category/category_job_list.html.twig', [
            'category' => $category,
            'jobs' => $category->getJobs(),
        ]);
    }
}
