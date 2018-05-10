<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/category/list", name="category.list")
     * @Method("GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findWithActiveJobs();

        return $this->render('category/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/category/{slug}/{page}", name="category.show", defaults={"page" = "1"}, requirements={"page" = "\d+"})
     * @Method("GET")
     *
     * @param Category $category
     * @param int $page
     * @return Response
     */
    public function show(Category $category, int $page): Response
    {
        /** @var Pagerfanta $pagerFanta */
        $pagerFanta = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findActiveByCategoryPaginated($category, $this->getParameter('max_jobs_per_category'));

        $pagerFanta->setCurrentPage($page);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'paginatedJobs' => $pagerFanta
        ]);
    }
}
