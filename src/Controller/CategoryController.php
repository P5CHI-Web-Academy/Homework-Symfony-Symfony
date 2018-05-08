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
     * @Route("/category/{slug}", name="job_list")
     * @Method("GET")
     * @param Category $category
     * @return Response
     */
    public function showJobList(Category $category): Response
    {
        return $this->render(
            'category/job_list.html.twig', [
            'categoryName' => $category->getName(),
            'jobs' => $category->getJobs(),
        ]);
    }
}
