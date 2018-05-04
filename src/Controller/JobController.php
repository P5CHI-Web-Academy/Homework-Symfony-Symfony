<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Job;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="app_job_list")
     * @Method("GET")
     */
    public function listAction(): Response
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findActiveJobs();

        return $this->render(
            'job/list.html.twig',
            [
                'jobs' => $jobs,
            ]
        );
    }

    /**
     * @Route("job/{id}", name="app_job_view", requirements={"id" = "\d+"})
     * @Method("GET")
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
