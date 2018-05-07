<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Job;
use App\Entity\Category;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="app_job_list")
     * @Method("GET")
     */
    public function listAction(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findWithActiveJobs();

        return $this->render(
            'job/list.html.twig',
            [
                'categories' => $categories,
            ]
        );
    }

    /**
     * @Route("job/{id}", name="app_job_view", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Entity("job", expr="repository.findActiveJob(id)")
     *
     * @param Job $job
     * @return Response
     */
    public function viewAction(Job $job): Response
    {
        return $this->render(
            'job/view.html.twig',
            [
                'job' => $job,
            ]
        );

    }
}
