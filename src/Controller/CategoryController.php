<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="category.")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}", name="job_list", defaults={"page": 1})
     * @Method("GET")
     * @param Category $category
     * @param int $page
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function showJobList(
        Category $category,
        int $page,
        PaginatorInterface $paginator
    ): Response {
        $jobs = $paginator->paginate(
            $this->getDoctrine()->getRepository(Job::class)->findJobsByCategoryQuery($category),
            $page,
            $this->getParameter('jobs_show_limit_category')
        );

        return $this->render('category/job_list.html.twig', [
            'categoryName' => $category->getName(),
            'jobs' => $jobs,
        ]);
    }
}
