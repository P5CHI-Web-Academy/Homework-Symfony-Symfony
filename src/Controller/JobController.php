<?php

namespace App\Controller;

use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jobs")
 */
class JobController extends AbstractController
{
    /**
     * @Route("/list", name="job.list")
     * @Method("GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findActive();

        return $this->render('job/index.html.twig', compact('jobs'));
    }

    /**
     * @Route("/{job}", name="job.show")
     * @Method("GET")
     *
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', compact('job'));
    }
}
