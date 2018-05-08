<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="job.")
 */
class JobController extends AbstractController {

    /**
     * @Route("/", name="list")
     * @Method("GET")
     * @return Response
     * @throws \LogicException
     */
    public function list(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findCategoriesWithActiveJobs();

        return $this->render('job/list.html.twig', [
           'categories' => $categories,
        ]);
    }

    /**
     * @Route("job/{id}", name="show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Entity("job", expr="repository.findActiveJob(id)")
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
