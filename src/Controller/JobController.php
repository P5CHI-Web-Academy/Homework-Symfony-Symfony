<?php

namespace App\Controller;

use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jobs")
 */
class JobController extends AbstractController
{
    /**
     * @Route("/", name="job.list")
     * @Method("GET")
     */
    public function index()
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findAll();

        return $this->render('job/index.html.twig', compact('jobs'));
    }
}
