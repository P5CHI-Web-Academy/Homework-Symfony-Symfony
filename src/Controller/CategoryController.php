<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="app_category_view")
     * @Method("GET")
     *
     * @param Category $category
     * @return Response
     */
    public function viewAction(Category $category): Response
    {
        return $this->render(
            'category/view.html.twig',
            [
                'category' => $category,
            ]
        );
    }
}
