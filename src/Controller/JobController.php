<?php

namespace App\Controller;

use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController {

    /**
     * @Route("/", name="job.list")
     * @Method("GET")
     * @return Response
     * @throws \LogicException
     */
    public function listAction(): Response
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findActiveJobs();

        return $this->render('job/list.html.twig', [
           'jobs' => $jobs
        ]);
    }

    /**
     * @Route("job/{id}", name="job.show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @param Job $job
     * @return Response
     */
    public function showAction(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job
        ]);
    }
}
