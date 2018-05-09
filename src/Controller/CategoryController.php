<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Category;
use App\Repository\JobRepository;

class CategoryController extends Controller
{
    /**
     * @Route(
     *     path="/category/{slug}/{page}",
     *     name="app_category_view",
     *     requirements={"page"="\d+"},
     *     defaults={"page"=1}
     * )
     * @Method("GET")
     *
     * @param Category $category
     * @param int $page
     * @param PaginatorInterface $paginator
     * @param JobRepository $jobRepository
     * @return Response
     */
    public function viewAction(
        Category $category,
        int $page,
        PaginatorInterface $paginator,
        JobRepository $jobRepository
    ): Response {

        $activeJobs = $paginator->paginate(
            $jobRepository->getActiveJobsByCategoryQuery($category),
            $page,
            $this->getParameter('max_jobs_on_category')
        );

        return $this->render(
            'category/view.html.twig',
            [
                'category' => $category,
                'activeJobs' => $activeJobs,
            ]
        );
    }
}
