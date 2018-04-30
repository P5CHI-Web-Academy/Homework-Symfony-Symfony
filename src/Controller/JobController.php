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
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();

        return $this->render(
            'job/list.html.twig',
            [
                'jobs' => $jobs,
            ]
        );
    }
}
