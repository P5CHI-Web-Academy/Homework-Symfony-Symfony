<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{

    /**
     * @Route("/categories", name="categories.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categories/{slug}/{page}", name="categories.show", defaults={"page": 1})
     * @Method("GET")
     * @param Category $category
     * @param int $page
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category, int $page, PaginatorInterface $paginator)
    {
        $jobs = $paginator->paginate(
            $this->getDoctrine()->getRepository(Job::class)->findPaginatedJobsByCategory($category),
            $page,
            $this->getParameter('pagination')
        );

        return $this->render('categories/show.html.twig', [
            'category' => $category,
            'jobs' => $jobs,
        ]);
    }
}
